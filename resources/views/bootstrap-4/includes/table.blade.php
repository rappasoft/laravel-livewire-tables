<div class="table-responsive">
    <table class="table table-striped">
        @include('livewire-tables::bootstrap-4.includes.header')

        <tbody>
            @if (count($bulkActions) && $selectPage && $rows->total() > $rows->count())
                <tr wire:key="row-message">
                    <td colspan="{{ count($bulkActions) ? count($columns) + 1 : count($columns) }}">
                        @unless ($selectAll)
                            <div>
                                <span>{!! __('You have selected <strong>:count</strong> users, do you want to select all <strong>:total</strong>?', ['count' => $rows->count(), 'total' => number_format($rows->total())]) !!}</span>

                                <button
                                    wire:click="selectAll"
                                    type="button"
                                    class="btn btn-primary btn-sm"
                                >
                                    @lang('Select All')
                                </button>
                            </div>
                        @else
                            <div>
                                <span>{!! __('You are currently selecting all <strong>:total</strong> users.', ['total' => number_format($rows->total())]) !!}</span>

                                <button
                                    wire:click="resetBulk"
                                    type="button"
                                    class="btn btn-primary btn-sm"
                                >
                                    @lang('Unselect All')
                                </button>
                            </div>
                        @endif
                    </td>
                </tr>
            @endif

            @forelse ($rows as $index => $row)
                <tr
                    wire:loading.class.delay="text-muted"
                    wire:key="table-row-{{ $row->getKey() }}"
                >
                    @if (count($bulkActions))
                        <td>
                            <input
                                wire:model="selected"
                                value="{{ $row->getKey() }}"
                                type="checkbox"
                            />
                        </td>
                    @endif

                    @include($rowView, ['row' => $row])
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($bulkActions) ? count($columns) + 1 : count($columns) }}">
                        @lang('No items found. Try narrowing your search.')
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
