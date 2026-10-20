const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const test = require('node:test');
const vm = require('node:vm');

class Element {
    constructor(tag, attributes = {}, classes = []) {
        this.tagName = tag.toUpperCase();
        this.attributes = attributes;
        this.children = [];
        this.parentNode = null;
        const values = new Set(classes);
        this.classList = {
            add: (...classes) => classes.forEach(value => values.add(value)),
            remove: (...classes) => classes.forEach(value => values.delete(value)),
            contains: value => values.has(value),
            [Symbol.iterator]: () => values[Symbol.iterator](),
        };
    }

    get id() { return this.getAttribute('id'); }
    get parentElement() { return this.parentNode; }
    get nextSibling() { return this.parentNode.children[this.parentNode.children.indexOf(this) + 1] ?? null; }
    get tBodies() { return this.children.filter(child => child.tagName === 'TBODY'); }
    get rows() {
        return this.children.flatMap(child => child.tagName === 'TR' ? [child] :
            ['THEAD', 'TBODY', 'TFOOT'].includes(child.tagName) ? child.rows : []);
    }
    get rowIndex() { return this.closest('table').rows.indexOf(this); }
    getAttribute(name) { return this.attributes[name] ?? null; }
    hasAttribute(name) { return Object.hasOwn(this.attributes, name); }
    getBoundingClientRect() { return { height: 40 }; }
    closest(selector) {
        if (selector === '[wire\\:id]' ? this.hasAttribute('wire:id') : this.tagName.toLowerCase() === selector) {
            return this;
        }
        return this.parentNode?.closest(selector) ?? null;
    }
    querySelectorAll(selector) {
        return this.children.flatMap(child => [
            ...(child.tagName.toLowerCase() === selector ? [child] : []), ...child.querySelectorAll(selector),
        ]);
    }
    getElementsByTagName(tag) { return this.querySelectorAll(tag); }
    append(...children) {
        children.forEach(child => { child.parentNode = this; this.children.push(child); });
    }
    insertBefore(child, before) {
        if (child === before) return;
        child.parentNode.children.splice(child.parentNode.children.indexOf(child), 1);
        assert.ok(before === null || before.parentNode === this);
        this.children.splice(before === null ? this.children.length : this.children.indexOf(before), 0, child);
        child.parentNode = this;
    }
}

function tableFixture(componentId, tableId = 'table-table') {
    const root = new Element('div', { 'wire:id': componentId });
    const wrapper = new Element('div', { 'x-data': '{}' });
    const table = new Element('table', { id: tableId });
    const head = new Element('thead');
    const body = new Element('tbody');
    const foot = new Element('tfoot');
    const bulk = new Element('tr');
    const collapsed = new Element('tr', {}, ['md:hidden']);
    const rows = ['1', '2', '3'].map((id, index) => new Element('tr', {
        id: `table-row-${id}`, rowpk: id,
    }, [index % 2 === 0 ? `${componentId}-even` : `${componentId}-odd`]));
    rows.forEach(row => row.append(new Element('td')));
    head.append(new Element('tr'));
    body.append(bulk, rows[0], collapsed, rows[1], rows[2]);
    foot.append(new Element('tr'));
    table.append(head, body, foot);
    wrapper.append(table);
    root.append(wrapper);
    return { root, wrapper, table, body, rows, bulk, collapsed };
}

function providersFrom(file, document) {
    const providers = new Map();
    const Alpine = { data: (name, provider) => providers.set(name, provider) };
    let source = fs.readFileSync(path.join(__dirname, '../../', file), 'utf8');
    source = source.replace(/export default (\w+);?/, '$1();');
    vm.runInNewContext(source, { document, Alpine }, { filename: file });
    return providers;
}

function mount(provider, fixture) {
    const calls = [];
    const properties = { defaultReorderColumn: 'sort', currentlyReorderingStatus: true };
    const wire = {
        $el: fixture.root,
        entangle: name => properties[name],
        get: name => properties[name],
        storeReorder: rows => calls.push(JSON.parse(JSON.stringify(rows))),
    };
    const state = provider(wire, fixture.table.id, 'id');
    state.tableId = fixture.table.id;
    state.primaryKeyName = 'id';
    state.$root = fixture.wrapper;
    state.$nextTick = callback => callback();
    return { state, calls };
}

function dragEvent(target, dataTransfer = transfer(), offsetY = 0) {
    return { target, dataTransfer, offsetY };
}

function transfer() {
    const values = new Map();
    return { setData: (type, value) => values.set(type, value), getData: type => values.get(type) ?? '' };
}

function setup(file, name, tableId) {
    const first = tableFixture('first', tableId);
    const second = tableFixture('second', tableId);
    const page = new Element('main');
    page.append(first.root, second.root);
    const document = {
        addEventListener: (name, callback) => callback(),
        getElementById: id => {
            const descendants = node => node.children.flatMap(child => [child, ...descendants(child)]);
            return descendants(page).find(element => element.id === id);
        },
    };
    const provider = providersFrom(file, document).get(name);
    return { first, second, provider, ...mount(provider, second) };
}

const variants = [
    ['resources/js/laravel-livewire-tables.js', 'laravellivewiretable'],
    ['resources/js/laravel-livewire-tables.js', 'reorderFunction'],
    ['resources/js/laravel-livewire-tables.min.js', 'laravellivewiretable'],
    ['resources/js/laravel-livewire-tables.min.js', 'reorderFunction'],
    ['resources/js/partials/reorder.js', 'reorderFunction'],
    ['resources/js/partials/reorder.min.js', 'reorderFunction'],
];

for (const [file, name] of variants) {
    const label = `${file}: ${name}`;

    for (const tableId of ['table-table', "orders:today['custom']"]) {
        test(`${label} reorders only its component with repeated row IDs (${tableId})`, () => {
            const { first, second, state, calls } = setup(file, name, tableId);
            state.setupEvenOddClasses();
            const dataTransfer = transfer();
            state.dragStart(dragEvent(second.rows[0], dataTransfer));
            state.dragOverEvent(dragEvent(second.rows[2].children[0], dataTransfer, 30));
            assert.ok(second.rows[2].classList.contains('laravel-livewire-tables-highlight-bottom'));
            state.dropEvent(dragEvent(second.rows[2].children[0], dataTransfer, 30));
            state.updateOrderedItems();
            assert.deepEqual(calls, [[{ id: '2', sort: 1 }, { id: '3', sort: 2 }, { id: '1', sort: 3 }]]);
            assert.deepEqual(first.body.rows.filter(row => row.hasAttribute('rowpk')), first.rows);
            assert.ok(second.rows[1].classList.contains('second-even'));
            assert.ok(second.rows[2].classList.contains('second-odd'));
            assert.ok(!second.rows[0].classList.contains('laravel-livewire-tables-dragging'));
            assert.ok(!second.rows[2].classList.contains('laravel-livewire-tables-highlight-bottom'));
        });
    }

    test(`${label} ignores structural rows and nested tables/components`, () => {
        const { second, state, calls } = setup(file, name);
        const nested = tableFixture('nested');
        second.root.children.unshift(nested.root);
        nested.root.parentNode = second.root;
        const inner = tableFixture('inner');
        second.rows[0].children[0].append(inner.table);
        state.updateOrderedItems();
        assert.deepEqual(calls, [[{ id: '1', sort: 1 }, { id: '2', sort: 2 }, { id: '3', sort: 3 }]]);
        state.dragStart(dragEvent(inner.rows[0]));
        assert.equal(state.sourceID, '');
        state.dragStart(dragEvent(nested.rows[0]));
        assert.equal(state.sourceID, '');
        state.setupEvenOddClasses();
        assert.deepEqual(Array.from(state.evenNotInOdd), ['second-even']);
    });

    test(`${label} can drop before a row and clear its highlight on drag leave`, () => {
        const { second, state, calls } = setup(file, name);
        const dataTransfer = transfer();
        state.dragStart(dragEvent(second.rows[2], dataTransfer));
        state.dragOverEvent(dragEvent(second.rows[0].children[0], dataTransfer));
        assert.ok(second.rows[0].classList.contains('laravel-livewire-tables-highlight-top'));
        state.dragLeaveEvent(dragEvent(second.rows[0].children[0], dataTransfer));
        assert.ok(!second.rows[0].classList.contains('laravel-livewire-tables-highlight-top'));
        state.dropEvent(dragEvent(second.rows[0].children[0], dataTransfer));
        state.updateOrderedItems();
        assert.deepEqual(calls, [[{ id: '3', sort: 1 }, { id: '1', sort: 2 }, { id: '2', sort: 3 }]]);
    });

    test(`${label} rejects cross-table and cross-component drops even with stale drag state`, () => {
        const { first, second, provider, state, calls } = setup(file, name);
        const firstState = mount(provider, first).state;
        state.dragStart(dragEvent(second.rows[0]));
        const foreignTransfer = transfer();
        firstState.dragStart(dragEvent(first.rows[0], foreignTransfer));
        state.dropEvent(dragEvent(second.rows[2], foreignTransfer, 30));
        state.updateOrderedItems();
        assert.deepEqual(calls, [[{ id: '1', sort: 1 }, { id: '2', sort: 2 }, { id: '3', sort: 3 }]]);
        assert.deepEqual(first.body.rows.filter(row => row.hasAttribute('rowpk')), first.rows);
        const sibling = tableFixture('second', 'sibling-table');
        second.root.append(sibling.wrapper);
        const siblingState = mount(provider, { ...sibling, root: second.root }).state;
        state.dragStart(dragEvent(second.rows[0]));
        const siblingTransfer = transfer();
        siblingState.dragStart(dragEvent(sibling.rows[0], siblingTransfer));
        state.dropEvent(dragEvent(second.rows[2], siblingTransfer, 30));
        assert.deepEqual(second.body.rows.filter(row => row.hasAttribute('rowpk')), second.rows);
        assert.deepEqual(sibling.body.rows.filter(row => row.hasAttribute('rowpk')), sibling.rows);
    });

    test(`${label} rejects foreign sources, targets, nested rows, and structural drop targets`, () => {
        const { first, second, state } = setup(file, name);
        state.dragStart(dragEvent(first.rows[0]));
        assert.equal(state.sourceID, '');
        const nested = tableFixture('nested');
        second.rows[2].children[0].append(nested.root);
        for (const target of [first.rows[2], nested.rows[2], second.bulk, second.collapsed, second.root]) {
            const dataTransfer = transfer();
            state.dragStart(dragEvent(second.rows[0], dataTransfer));
            state.dragOverEvent(dragEvent(target, dataTransfer));
            state.dragLeaveEvent(dragEvent(target, dataTransfer));
            state.dropEvent(dragEvent(target, dataTransfer));
            assert.deepEqual(second.body.rows.filter(row => row.hasAttribute('rowpk')), second.rows);
            assert.deepEqual(first.body.rows.filter(row => row.hasAttribute('rowpk')), first.rows);
        }
    });

    test(`${label} safely handles a missing own table, source, and empty or single-row tables`, () => {
        const { first, second, state, calls } = setup(file, name);
        const nested = tableFixture('nested');
        second.rows[0].children[0].append(nested.table);
        second.table.attributes.id = 'unrelated-table';
        state.setupEvenOddClasses();
        state.dragStart(dragEvent(first.rows[0]));
        state.dragOverEvent(dragEvent(second.rows[0]));
        state.dragLeaveEvent(dragEvent(second.rows[0]));
        state.dropEvent(dragEvent(second.rows[0]));
        state.updateOrderedItems();
        assert.deepEqual(calls, []);
        second.table.attributes.id = 'table-table';
        state.sourceID = 'missing-row';
        state.dropEvent(dragEvent(second.rows[0]));
        second.body.children = [];
        state.setupEvenOddClasses();
        state.updateOrderedItems();
        assert.deepEqual(calls, [[]]);
        second.body.append(second.rows[0]);
        const dataTransfer = transfer();
        state.dragStart(dragEvent(second.rows[0], dataTransfer));
        state.dropEvent(dragEvent(second.rows[0], dataTransfer));
        state.updateOrderedItems();
        assert.deepEqual(calls, [[], [{ id: '1', sort: 1 }]]);
    });
}
