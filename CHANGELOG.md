# Changelog

All notable changes to `laravel-livewire-tables` will be documented in this file

## [v3.2.5] - 2024-04-30
### New Features
- Add setConfigurableArea by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1706
- Add User prompt for missing inputs by @achyutkneupane in https://github.com/rappasoft/laravel-livewire-tables/pull/1681

### Bug Fixes
- UI patch: toolbar fix for reordering by @itsLeonB in https://github.com/rappasoft/laravel-livewire-tables/pull/1690

### Tweaks
- Adjust Workflow behaviour for PCOV by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1706
- Updated nl language by @Jerimu in https://github.com/rappasoft/laravel-livewire-tables/pull/1695
- Updated nl language by @Jerimu in https://github.com/rappasoft/laravel-livewire-tables/pull/1694

## [v3.2.4] - 2024-03-01
### Bug Fixes
- Collapsing Columns fix when multiple tables are displayed on a page by @lrljoe

## [v3.2.3] - 2024-03-01
### New Features
- Add capability to customise colors/styling on the Pagination Per-Page Dropdown by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1677

### Docs
- Amend Lifecycle Hooks document to use "public" rather than "protected" methods

## [v3.2.2] - 2024-02-29
### New Features
- Add setDefaultPerPage by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1671

## [v3.2.1] - 2024-02-24
### Bug Fixes
- Fix collapsing columns not respecting view point collapse points by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1665

### Tweaks
- Migrate "updated" Search and FilterComponents calls to WithSearch and WithFilters by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1666
- Allow nullable search/filter values by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1666

## [v3.2.0] - 2024-01-04
### Tweaks
- Migration to new Core Traits, and de-duplication of code by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1623 

## [v3.1.9] - 2023-12-29
### Bug Fixes
- Fix CHANGELOG.md missing release

## [v3.1.8] - 2023-12-29
### New Features
- Add capability to show/hide Pagination Details (Rows x of y) by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1618
- Add perPage to queryString by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1618

## [v3.1.7] - 2023-12-29
### Bug Fixes
- Fix published view path by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1615

## [v3.1.6] - 2023-12-26
### New Features
- Add capability to call a new "addAdditionalSelects()" to append select table fields (without impacting setAdditionalSelect) by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1609

### Bug Fixes
- Ensure mount() is called prior to bundler() executing by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1603

## [v3.1.5] - 2023-12-09
### New Features
- Add capability to use as a Full Page Component by @amshehzad and @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1580
- Add DateColumn by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1589
- Add ColorColumn by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1590

### Tweaks
- Internal - modify GitHub workflows to improve caching, but use unique caches per workflow matrix
- Internal - remove superfluous PHPStan ignoreErrors
- Internal - update Test Suite to also test at PHP 8.3
- Internal - tidying Classes & Traits by @lrljoe
- Docs - Update Anonymous Column documents to reference ability to use strings as well as views

## [v3.1.4] - 2023-12-04
### New Features
- Add capability to hide Column Label by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1512
- Add capability to set a custom script path for the scripts/styles by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1557
- Added rowsRetrieved Lifecycle Hook, expanded documentation for Lifecycle Hooks

### Bug Fixes
- Added missing tailwind background colour class for when hovering over the clear button in dark mode by @slakbal in https://github.com/rappasoft/laravel-livewire-tables/pull/1553
- Fixed extraneous space in config.php by @viliusvsx in in https://github.com/rappasoft/laravel-livewire-tables/pull/1577
- Changed table default vertical overflow to auto by @dmyers in https://github.com/rappasoft/laravel-livewire-tables/pull/1573
- Fix footer rendering issue with extra td displayed depending on bulk action statuses
- Create new WithCustomisations Trait
- Move render data provision into Traits -> WithColumns, WithCustomisations, WithData
- Add default pint.json with ignore for WithAllTraits
- Updated tests & test cases to cater for No Primary Key more efficiently

### Tweaks
- Create additional Exception Classes (NoColumnsException, NoSearchableColumnsException, NoSortableColumnsException)
- Revert previous splitting of JS Files
- Add capability to customise Bulk Actions Styling with tests by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1564
  - TH Classes
  - TH Checkbox Classes
  - TD Classes
  - TD Checkbox Classes

## [v3.1.3] - 2023-11-03
- Add additional Lifecycle Hook by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1534
  - SettingColumns/ColumnsSet
- Migrate methods for pre-render out of render by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1534
- Update tests to reflect hooks by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1534
- Update tests to add invalid string tests for dates by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1534
- Remove maps and minimise functions from FrontendAssets by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1534

## [v3.1.2] - 2023-11-03
- Add Initial Lifecycle Hooks - Configuring/Configured by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1520
  - Configuring/Configured
- Add missing tests for DateFilter and DateTimeFilter by @lrljoe in https://github.com/rappasoft/laravel-livewire-tables/pull/1527

## [v3.1.1] - 2023-11-02
### New Features
- Add setCustomView for Filters

### Bug Fixes
- Default Search to "Live" rather than "Defer" to match v2

### Tweaks
- Modify Filters to use DTO for Generic Property List by @lrljoe in [#1503](https://github.com/rappasoft/laravel-livewire-tables/pull/1503)
- Split ConfigurableAreas, CollapsingColumns and  TableAttributes into own Traits/Config/Helper Files for Maintainability by @lrljoe in [#1514](https://github.com/rappasoft/laravel-livewire-tables/pull/1514)
- Add "HasAllTraits" for Maintainability by @lrljoe in [#1514](https://github.com/rappasoft/laravel-livewire-tables/pull/1514)
- Rename row-contents to collapsed-columns
- Add IsFilter and IsColumn Traits for Filter/Column Classes

## [v3.1.0] - 2023-10-31
- Restore wire:confirm for Bulk Actions
- Stable Release of 3.1.0 Stable for Livewire v3 Support

## [3.0.0-beta.11] - 2023-10-29
- Update Date Range Icon Styling
- Migrate PHP from date-range blade into new DateRangeFilter method
- Add FilterHelper method for generating filter wire:keys
- Add Filter CustomPosition tests
- Add Placeholder config option for DateRangeFilter
- Add Placeholder config option for DateFilter, DateTimeFilter, NumberFilter
- Clean up classes on filters
- Minor tweaks to toolbar/column select styling
- Fix wire:confirm for BulkActions (removed in merge error)

## [3.0.0-beta.10] - 2023-10-27
- Changes to toolbar blade structure by @lrljoe in #[1454](https://github.com/rappasoft/laravel-livewire-tables/pull/1454) 
- Fix queryStringEnabled by @lrljoe in #[1465](https://github.com/rappasoft/laravel-livewire-tables/pull/1465) 
- Add missing x-cloak by @lrljoe in #[1463](https://github.com/rappasoft/laravel-livewire-tables/pull/1463) 

## [3.0.0-beta.9] - 2023-10-27
- Fixes for missing default behaviour by @lrljoe in #[1455](https://github.com/rappasoft/laravel-livewire-tables/pull/1455)

## [3.0.0-beta.8] - 2023-10-26
- Fix for setFilter - allows setting values at mount/boot (#1451) by @lrljoe in #[1452](https://github.com/rappasoft/laravel-livewire-tables/pull/1452)


## [3.0.0-beta.7] - 2023-10-25
- Add wire:navigate option for clickable rows

## [3.0.0-beta.6] - 2023-10-25
- Fix for collapsing column header shift

## [3.0.0-beta.5] - 2023-10-25
- Fix Return Type hinting for Column Rendering to allow Enum columns
- Add Bulk Action Confirmations, using wire:confirm
  - setBulkActionConfirms
  - setBulkActionConfirmMessage
  - setBulkActionConfirmMessages 
  - setBulkActionDefaultConfirmationMessage
  - Localisation for confirmation message

## [3.0.0-beta.4] - 2023-10-17
- Introduction of Loading Placeholder
- Docs livewire namespace fix [Here](https://github.com/rappasoft/laravel-livewire-tables/pull/1420)
- Add CollapseAlways capability for Columns
- Fix localisation bug

## [3.0.0-beta.3] - 2023-10-13
- Fix for Livewire ^3.0.6 where the table loading causes an additional lifecycle
- Add unminified files to .gitattributes export-ignore
- Increase cached time to 1 day from 1 hour if cache is enabled

## [3.0.0-beta.2] - 2023-10-08
- Removes superfluous @endphp from the DateRangeFilter blade
- Removes reference to remote/published 3rd party assets
- Add setFilterLabelAttributes Capability Per-Filter
- Fix for reorder sort not applying automatically

## [3.0.0-beta.1] - 3.x Initial Release
- Amending Documentation for Reordering
- Adding capabilities & tests for setTrAttributes
- Force calculation of even/odd only once in reorder mode
- Call internal method for reordering, and pass to configured method to process
- Amend AutoInjection/FrontendAsset to ensure it returns the original content correctly
- Remove errant disabling of Blade Directives when disabling auto-injection
- Amended in-line config documentation
- Add setSearchFieldAttributes() and getSearchFieldAttributes()
- Add missing pagination tests
- Removal of setSearchLazy
- Fix for setSearchDebounce
- Fix publishing of views
- Fix for Bulk Actions dropdown not working in Bootstrap
- Fix for Column Select "Select All" not consistently updating
- Fix for lazy loading of table
- Fix for ColumnSelect falling out of sync, displaying unselectable colums, or persisting cols in query that are not selected
- Add setSearchBlur()
- Add setSearchThrottle()
- Add publish translations
- Add prependColumns() and appendColumns() functions
- Add documentation for setSearchPlaceholder()

- Add setExcludeDeselectedColumnsFromQueryEnabled and setExcludeDeselectedColumnsFromQueryDisabled methods to configure()

- Requirements Change
    - Requires LiveWire 3.x
    - Requires PHP 8.1+
    - Requires Laravel 10+


- Core Changes
    - Move sorts, search, selectedColumns out of the traditional __$this->{$this->getTableName()}['sorts']__ and instead place it directly within the component.  This:
        - Improves the query string behaviour
        - Reduces the need to repeatedly set up that main array
        [Commit 1 Here](https://github.com/LowerRockLabs/laravel-livewire-tables-v3/commit/d7ccabfc8adefeb4bddcbac64831ef1a688527a8)
        [Commit 2 Here](https://github.com/LowerRockLabs/laravel-livewire-tables-v3/commit/0d8d98546b6a8051c4197804cc33b515faa02b07)

    - Tidying
        - Removed Spatie Package Tools and replaced with a generic service provider
        - Significant reduction in blade/view sizes, and repetition of code across Tailwind/Bootstrap 4/Bootstrap 5 themes
        - Uses HeroIcons instead of hard-coded SVGs for icons
        - Several variables are now inherited instead of being passed (e.g. Table Name)
        - Change to how Filters are rendered (no longer receives $component)
        - Wire keys and IDs now all conform to a format

    - Features
        - General
            - Added support for cursor pagination
            - Cursor & Simple pagination both include a "Total Item Count" stored in $paginationTotalItemCount
            - Added support for multiple relations on a single table (e.g. user has a "mother user" and a "father user")
            - Replaced dependency on unsupported Sortable JS libraries.
            - Option for a Search Placeholder to be set
            - Bootstrap striping is now fully working

        - Filters
            - Filter Construct calls config([]) by default to set configuration defaults, to avoid errors
            - Added Numeric Range filter
            - Added Date Range filter
            - DateFilter & DateTimeFilter have customisable Pills Date Format
            - DateFilter & DateTimeFilter fully support setFilterDefaultValue
            - MultiSelectFilter & MultiSelectDropdownFilter both support setFirstOption()
            - There are now two arrays relating to Filters:
                - A wireable one ($filterComponents)
                - An unwired one - only keeps track of those filters that have a value ($appliedFilters).  This is what is bound to the query string, and populates the filters on mount if they are present in the query string.
        
        - Livewire 3 Specific
            - Migrated any $component->id reference to $component->getId()
            - Added SetSearchLive to allow for the search to be "live", with tests
            - Added capability for external CSS file
            - Custom CSS/JS and Alpine components are now stored in an external file, which has configurable injection options
            - Added setSearchLive(), setSearchThrottle(int $milliseconds) and setSearchBlur() options for Search behaviour

- Test Changes
    - Temporarily removed the sort_events_apply_correctly and filter_events_apply_correctly due to LW3 not using Emit anymore.

    - Added extra column to the PetsTable -> last_visit and associated test changes to make the counts work.  This column is deselected() by default to allow for testing on those methods.

- Doc Changes
    - Slowly begun updating the docs with the relevant new features, dependencies etc.



## [2.15.0] - 2023-07-15

- Fixes
    - Re-enable capability for configuring whether to Hide/Show Bulk Actions when empty - https://github.com/rappasoft/laravel-livewire-tables/pull/1240

- Enhancements
    - Allow Label Columns to be Sortable - https://github.com/rappasoft/laravel-livewire-tables/pull/1256
    - Add Select All On Page Translations - https://github.com/rappasoft/laravel-livewire-tables/pull/1244
    - Add Contributors Document to track Localisation contributors - https://github.com/rappasoft/laravel-livewire-tables/pull/1223
    
## [2.14.0] - 2023-05-18

### Changed
- Fixes
    - Bulk Actions (AlpineJS)
    - Moving Table Head Checkbox to AlpineJS
    - Using AlpineJS for calculating if all items have been selected
    - Correcting missing x-cloak
    - Added indeterminateCheckbox for TH for bulk actions
    - Cleaned up ALpineJS functionality for Bulk Actions
    - Repair of tests that were looking for wire:model that no longer existed

- Enhancements
    - Several new public variables for accessing pagination data cleanly, to avoid calling functions repeatedly across various blades.
        - paginationTotalItemCount (Total number of items in the results across all page)
        - paginationCurrentItems (Primary keys of items in the current page)
        - paginationCurrentCount (Number of results on the current page)

- Blades
    - Several blades have had the classic Tables approach ($theme == 'tailwind', $theme == 'bootstrap) replaced with conditional classes using the @class([]) approach.  This is to reduce the complexity of the blade files.

## [2.13.1] - 2023-05-18

### Changed

- Fixes for AlpineJS

## [2.13.0] - 2023-05-17

### Changed
- General
  - Migrate to AlpineJS for Bulk Actions  - https://github.com/rappasoft/laravel-livewire-tables/pull/1196
  - Add capability for passing a custom model path to the MakeCommand  - https://github.com/rappasoft/laravel-livewire-tables/pull/1168
  - Add setFilterDefaultValue() on a per-component basis  - https://github.com/rappasoft/laravel-livewire-tables/pull/1191
  - Add getFilterDefaultValue() to each Filter Component (to maintain support for PHP7.4 - variable return types)  - https://github.com/rappasoft/laravel-livewire-tables/pull/1191
  - Moved Setting of Filter Defaults to Traits/Helpers/FilterHelpers - mountFilterHelpers  - https://github.com/rappasoft/laravel-livewire-tables/pull/1191
  - Moved Setting of Theme to Traits/ComponentUtilities - mountComponentUtilities for efficiency  - https://github.com/rappasoft/laravel-livewire-tables/pull/1191
  
- Filters
  - *Fix* - Hide the filter label in the header/footer when using as a secondary header/footer
  - *Fix* - Changed the booting order to prevent repeated calling of filters() - https://github.com/rappasoft/laravel-livewire-tables/pull/1166 
  - *Fix* - fixed multiSelectDropdownFilter in menus - https://github.com/rappasoft/laravel-livewire-tables/pull/1160 
  - *Fix* - TypeHint to allow continued support of PHP 7.4 - https://github.com/rappasoft/laravel-livewire-tables/pull/1185

- Documentation
  - *Fix* - Minor wording tweak to documentation - https://github.com/rappasoft/laravel-livewire-tables/pull/1139 
  - *Fix* - Fix to example in applying-filters - https://github.com/rappasoft/laravel-livewire-tables/pull/1171
  - Improved template for New Issue/Bug - https://github.com/rappasoft/laravel-livewire-tables/pull/1194 

- Tests
  - Restore PHP 7.4 tests for L8 only (includes minor tweaks)
  - Remove duplicate tests in ComponentHelpersTest
  - Tweak to ReorderingVisualsTest
  - Add TextFilter as a test in FilterHelpersTest

- Localization
  - Added Danish Localization - https://github.com/rappasoft/laravel-livewire-tables/pull/1206

## [2.12.0] - 2023-04-08

### Added

- AlpineJS Variable for Toolbar Dropdowns to force the dropdown to remain open - childElementOpen - https://github.com/rappasoft/laravel-livewire-tables/pull/1076
- Added Custom Column Slug method setCustomSlug('') allowing Columns to use non-roman characters in the Column Title - https://github.com/rappasoft/laravel-livewire-tables/pull/1088
- Eager loading so anyone can load any type of relationship - https://github.com/rappasoft/laravel-livewire-tables/pull/943
- Improved visibility of active page in pagination - https://github.com/rappasoft/laravel-livewire-tables/pull/1096
- Pagination methods
  - Retrieve currently displayed IDs - getPerPageDisplayedItemIds() 
  - Retrieve number of records currently displayed - getPerPageDisplayedItemCount()
  - Public variables for the above https://github.com/rappasoft/laravel-livewire-tables/pull/1136

- Filter Changes - https://github.com/rappasoft/laravel-livewire-tables/pull/1129
  - Custom Filter Pill Blades per Filter component (setFilterPillBlade()) - https://github.com/rappasoft/laravel-livewire-tables/pull/1107
  - Custom Filter Label Blades per Filter component (setCustomFilterLabel()) - https://github.com/rappasoft/laravel-livewire-tables/pull/1110
  - Filter positioning options when using slide-down - https://github.com/rappasoft/laravel-livewire-tables/pull/1108
    - Set the row per Filter component (setFilterSlidedownRow())
    - Set the colspan per Filter component (setFilterSlidedownColspan())

### Changed

- Filters
  - *Fix* - enabled re-use of Filters in Secondary Header/Footer, fixing issue where the filter remains visible after deselecting the Column- https://github.com/rappasoft/laravel-livewire-tables/pull/1108
  - *Fix* - restrict AppliedFilters to only return non-empty - preventing default values from setting the filter https://github.com/rappasoft/laravel-livewire-tables/pull/1080
  - *Minor* - added ID to Filter Wrapper allowing for easier targeting in blades/AlpineJS - https://github.com/rappasoft/laravel-livewire-tables/pull/1087

- Workflow Changes
  - PHPStan - Introducing PHP-Stan at Level 3 to ensure code-quality persists - https://github.com/rappasoft/laravel-livewire-tables/pull/1133
  - Run-Tests - Use of ParaTest, Composer Caching, Fixing the Stability Matrix clash - https://github.com/rappasoft/laravel-livewire-tables/pull/1105
  - php-cs-fixer - (For Badge) - https://github.com/rappasoft/laravel-livewire-tables/pull/1125 / https://github.com/rappasoft/laravel-livewire-tables/pull/1126

- Testing
  - Significant quantity of tests, improving test coverage from 81% to 91% - https://github.com/rappasoft/laravel-livewire-tables/pull/1137
  - General DocType/TypeHint Fixes https://github.com/rappasoft/laravel-livewire-tables/pull/1133

## [2.11.0] - 2023-02-16

### Added

- Support for Laravel 10 - https://github.com/rappasoft/laravel-livewire-tables/pull/1049
- Trigger events when changing selected columns - https://github.com/rappasoft/laravel-livewire-tables/pull/1046
- Added before-tools configurable area - https://github.com/rappasoft/laravel-livewire-tables/pull/1037
- Added support to hide column select on tablet or mobile - https://github.com/rappasoft/laravel-livewire-tables/pull/1031

### Changed

- Corrected issue in filter docs - https://github.com/rappasoft/laravel-livewire-tables/pull/1048
- Fixed filter pill values for option groups - https://github.com/rappasoft/laravel-livewire-tables/pull/1044

## [2.10.0] - 2023-01-16

### Added

- Added support for MorphOne relationships - https://github.com/rappasoft/laravel-livewire-tables/pull/844
- Added MultiSelectDropdownFilter - https://github.com/rappasoft/laravel-livewire-tables/pull/1011
- FilterSlideDown - Ability to set Default to Open or Closed - https://github.com/rappasoft/laravel-livewire-tables/pull/1017

### Changed

- Updated EN translations - https://github.com/rappasoft/laravel-livewire-tables/pull/999
- Updated ES translations - https://github.com/rappasoft/laravel-livewire-tables/pull/1000
- Bulk Actions Simple Pagination fix & typo in toolbar.blade.php - https://github.com/rappasoft/laravel-livewire-tables/pull/1015

## [2.9.0] - 2022-12-21

### Added

- Added support for optgroups in SelectFilter - https://github.com/rappasoft/laravel-livewire-tables/pull/962
- Added information about applying filters on boot - https://github.com/rappasoft/laravel-livewire-tables/pull/949
- Added ComponentColumn - https://github.com/rappasoft/laravel-livewire-tables/pull/827
- Added ability to set the pagination mode of `standard` or `simple`

### Changed

- Fixed formatting for relational column - https://github.com/rappasoft/laravel-livewire-tables/pull/757
- Fixed errors when filter does not exist - https://github.com/rappasoft/laravel-livewire-tables/pull/979
- Update basic example to represent V2 requirements - https://github.com/rappasoft/laravel-livewire-tables/pull/944
- Fixed responsive on bootstrap 4 & 5 - https://github.com/rappasoft/laravel-livewire-tables/pull/903
- Fix for select and checkbox inputs styling with Bootstrap 5 theme - https://github.com/rappasoft/laravel-livewire-tables/pull/864

## [2.8.0] - 2022-07-24

### Added

- Added functionality to bookmark or deep link column selection
- Added functionality to identify different datatable components as unique in column selection
- Added functionality to configure query string alias
- Added functionality to configure session key for column selection (dataTableFingerprint)
- Added functionality to select/deselect all columns in column selection dropdown
- Added French translation - https://github.com/rappasoft/laravel-livewire-tables/pull/816
- Added Malay translation - https://github.com/rappasoft/laravel-livewire-tables/pull/821
- Added Dutch translation - https://github.com/rappasoft/laravel-livewire-tables/pull/834
- Added Ukranian translation - https://github.com/rappasoft/laravel-livewire-tables/pull/840

### Changed

- Fixed bug with sort callback on newer versions of Livewire - https://github.com/rappasoft/laravel-livewire-tables/pull/805
- Fixed: Removed :mixed return type hint as it requires PHP8.0 - https://github.com/rappasoft/laravel-livewire-tables/pull/822
## [2.7.0] - 2022-05-07

### Added

- Added functionality to hide individual filters from popover and slide down views
- Added functionality to hide individual filters from filter pills
- Added functionality to hide individual filters from the active filter count
- Added functionality to say which filters get reset by the clear button
- Added functionality to set filters as secondaryHeader or footer of columns
- Added Brazilian Portuguese translation - https://github.com/rappasoft/laravel-livewire-tables/pull/797

## [2.6.0] - 2022-05-05

### Added

- Added functionality to display BooleanColumn as Yes/No instead of icons.
- Added ButtonGroupColumn for multiple LinkColumns in one group. Pretty much built in action buttons support.
- Added bulk action export example to docs.

## [2.5.0] - 2022-05-03

### Added

- Ability to pass mount parameters to configurable areas

### Changed

- Move configure call to boot instead of booteed.
- Mount methods now available in `configure()` method.
- Non-field columns with a searchable callback are now included in the search query.
- Fixed debug query output duplicating select statements.
- Fixed header issue on column hide - https://github.com/rappasoft/laravel-livewire-tables/pull/754

### Removed

- Calls to set builder and columns in render as it doesn't seem to make a difference since it's also called in booted.

## [2.4.0] - 2022-04-30

### Added

- Added table event listeners to sort/filter/clear from other components.
- Added text filter.
- Added $row as second parameter to BooleanColumn `setCallback()`.
- Added `setThSortButtonAttributes()` to set attributes for th sort button.
- Added `setHideConfigurableAreasWhenReorderingStatus()` to hide configurable areas when reordering status which now defaults to true.

### Changed

- Rework builder to fix passed parameters in `builder()` and `columns()` methods.
- Fixed possible bug with bulk actions dropdown on Tailwind when bulk actions are hidden until a selection is made.

## [2.3.0] - 2022-04-28

### Added

- Added ability to define additional select statements outside the scope of a column using the `setAdditionalSelects(array $selects)` configuration method.
- Added 8 configurable areas, see `Configurable Areas` of the `Datatable` section of the documentation.

## [2.2.1] - 2022-04-27

### Changed

- Fixed filter dropdown opening on sort - https://github.com/rappasoft/laravel-livewire-tables/pull/740

## [2.2.0] - 2022-04-25

### Added

- Added space to include custom markup at the end of the component.
- Added events documentation
- Added ability to set columns as deselected by default - https://github.com/rappasoft/laravel-livewire-tables/pull/731
- Added NumberFilter - https://github.com/rappasoft/laravel-livewire-tables/pull/729
### Changed 

- Fixed issue with Postgres and quotes - https://github.com/rappasoft/laravel-livewire-tables/pull/734

## [2.1.0] - 2022-04-12

### Added

- Turkish Translation - https://github.com/rappasoft/laravel-livewire-tables/pull/686
- Added missing table row click functionality
- Added ability to mark column as unclickable if you need a cell to have another clickable element with clickable rows turned on.

### Changed

- Update filter docs - https://github.com/rappasoft/laravel-livewire-tables/pull/691
- Update getTdAttributes to take 4th missing argument
- Add filters in the config section - https://github.com/rappasoft/laravel-livewire-tables/pull/709
- Update some docs formatting

## [2.0.0] - 2022-03-30

Ground Up Rebuild

## [1.21.0] - 2021-11-20

### Added

- Added Chinese translation - https://github.com/rappasoft/laravel-livewire-tables/pull/540
- Added 'select all' checkbox for multiselect filters - https://github.com/rappasoft/laravel-livewire-tables/pull/551
- Added attributes to filters - https://github.com/rappasoft/laravel-livewire-tables/pull/558
- Added 4th option for pills fallback value - https://github.com/rappasoft/laravel-livewire-tables/pull/538

### Changed

- Removed excess left padding on Bootstrap 5 form check on multiselect filters.
- Patch bulk actions random wire:key - https://github.com/rappasoft/laravel-livewire-tables/pull/557

## [1.20.1] - 2021-11-01

### Changed

- Fix bulk actions breaking change - https://github.com/rappasoft/laravel-livewire-tables/pull/535

## [1.20.0] - 2021-10-25

### Added

- Singular row translation - https://github.com/rappasoft/laravel-livewire-tables/pull/526

### Changed

- Fixed bulk actions dropdown on Bootstrap - https://github.com/rappasoft/laravel-livewire-tables/pull/519
- Fixed bulk row/select with pagination off - https://github.com/rappasoft/laravel-livewire-tables/issues/510
- Conditionally show cursor-pointer class instead of inline style - https://github.com/rappasoft/laravel-livewire-tables/pull/529

## [1.19.3] - 2021-10-25

### Changed

- Fix bulk actions - https://github.com/rappasoft/laravel-livewire-tables/pull/517

## [1.19.2] - 2021-10-15

### Added

- German translation - https://github.com/rappasoft/laravel-livewire-tables/pull/502

### Changed

- Extracts just the field name from primaryKey - https://github.com/rappasoft/laravel-livewire-tables/pull/506
- Update BS4 pagination - https://github.com/rappasoft/laravel-livewire-tables/pull/507
- Update minimum Livewire version to 2.6

## [1.19.1] - 2021-10-14

### Changed

- Fixed table target default

## [1.19.0] - 2021-10-14

### Added

- Thai translation - https://github.com/rappasoft/laravel-livewire-tables/pull/491
- Italian translation - https://github.com/rappasoft/laravel-livewire-tables/pull/493
- Added getTableRowUrlTarget to set row click target based on the row
- Add custom class to table - https://github.com/rappasoft/laravel-livewire-tables/pull/495

### Changed

- Fix removing a multiselect filter - https://github.com/rappasoft/laravel-livewire-tables/pull/494

## [1.18.0] - 2021-10-13

### Added

- Secondary header (see documentation section `Secondary Header Functionality` on how to implement column search)

### Changed

- Add missing properties to reordering session

## [1.17.0] - 2021-10-12

### Added

- Multiselect filter - https://github.com/rappasoft/laravel-livewire-tables/pull/469

### Changed

- Fixed default version of livewire - https://github.com/rappasoft/laravel-livewire-tables/issues/486
- Fix bulk select with search and add typed property to selected - https://github.com/rappasoft/laravel-livewire-tables/pull/439

## [1.16.0] - 2021-09-26

### Added

- Ability to use the header as the footer
- Ability to define a custom footer cell per column
- Ability to set the footer row classes/id/attributes
- Ability to set the footer cell classes/id/attributes
- Added isHtml method on the column and replace use of property in views for internal use.
- [Ability to define bulk actions with a method](https://github.com/rappasoft/laravel-livewire-tables/pull/467)
- [Allow to disable responsive status of the table](https://github.com/rappasoft/laravel-livewire-tables/pull/458)
- [Ability to link each cell](https://github.com/rappasoft/laravel-livewire-tables/pull/461)

### Changed

- [Reduce horizontal spacing in Tailwind responsive view](https://github.com/rappasoft/laravel-livewire-tables/pull/464)

## [1.15.0] - 2021-09-19

### Added

- Dark styles for Tailwind

### Changed

- Minimum Livewire version to 2.6.2 to avoid 2.6.1 bug.
- Remove our custom pagination as Livewire 2.6 supports multiple pagination per page now.

## [1.14.0] - 2021-08-31

### Added

- Added [ID language file](https://github.com/rappasoft/laravel-livewire-tables/pull/444)
- Added [ability to preselect columns](https://github.com/rappasoft/laravel-livewire-tables/pull/436)
- Added ability to turn off column session
- [Support virtual columns](https://github.com/rappasoft/laravel-livewire-tables/pull/447)
- Added ability to dump filters above table for debugging

## [1.13.0] - 2021-08-24

### Added

- [Spanish translation](https://github.com/rappasoft/laravel-livewire-tables/pull/433)

### Changed

- [Use package tool to register commands](https://github.com/rappasoft/laravel-livewire-tables/pull/434)
- [Fix callback so it doesn't care about parameter names](https://github.com/rappasoft/laravel-livewire-tables/pull/438)
- Changed default empty text

## [1.12.0] - 2021-07-31

### Added

- [Make datatable command](https://github.com/rappasoft/laravel-livewire-tables/pull/408)

## [1.11.0] - 2021-07-10

### Added

- [Added `addAttributes` method to column headers](https://github.com/rappasoft/laravel-livewire-tables/pull/379)

### Changed

- Increased minimum Livewire version
- Added default empty message to lang file.
- [Fix people messing with sort direction from URL](https://github.com/rappasoft/laravel-livewire-tables/pull/389)
- [Check to make sure column exists before sorting](https://github.com/rappasoft/laravel-livewire-tables/pull/390)
- Removed ability to alter per page dropdown select to bypass allowed values.

## [1.10.4] - 2021-06-23

### Added

- Added $hideBulkActionsOnEmpty to hide the bulk actions dropdown until something is selected.

## [1.10.3] - 2021-06-22

### Added

- When reordering, the last known state of the table is now saved in the session so when you're done reordering you are back where you left off and no filters/sorts/search is lost.

### Changed

- Fixed query string getting wiped out on reload

## [1.10.2] - 2021-06-21

### Changed

- [Use Alpine binding syntax to avoid conflicts with Vue](https://github.com/rappasoft/laravel-livewire-tables/pull/354)

## [1.10.1] - 2021-06-20

### Changed

- Fixed Tailwind column popup on reorder

## [1.10.0] - 2021-06-20

**This release requires re-publishing of assets.**

### Added

- [Column selector for users to show/hide columns](https://github.com/rappasoft/laravel-livewire-tables/wiki/User-column-selection)
- [Drag & Drop reordering](https://github.com/rappasoft/laravel-livewire-tables/wiki/Drag-and-drop)

## [1.9.0] - 2021-06-15

**This release requires re-publishing of assets.**

### Added

- [Date filters](https://github.com/rappasoft/laravel-livewire-tables/pull/332)

### Changed

- Replaced bootstrap dropdowns with Alpine on bootstrap themes which fixes them closing prematurely when selecting filters.
- Added wrapping divs around needed `if` statements.
- Fixed Bootstrap pagination DOM-diffing issues.

## [1.8.0] - 2021-06-06

### Added

- [Actual default sorting](https://github.com/rappasoft/laravel-livewire-tables/pull/313)
- [Added place to put modals in the scope of the component](https://github.com/rappasoft/laravel-livewire-tables/wiki/Working-with-modals)
- Added `setTableRowClass`, `setTableRowId`, `setTableRowAttributes`, `setTableDataClass`, `setTableDataId`, `setTableDataAttributes` methods to modify cells and rows depending on data for non-custom rows.

### Changed

- [Fix tailwind style for div containing checkbox](https://github.com/rappasoft/laravel-livewire-tables/pull/314)

## [1.7.1] - 2021-05-30

### Added

- [Arabic translation file](https://github.com/rappasoft/laravel-livewire-tables/pull/299)

### Changed

- [Fix select tag className in Bootstrap 5](https://github.com/rappasoft/laravel-livewire-tables/pull/291)

## [1.7.0] - 2021-05-18

### Added

- [Ability to turn off filter dropdown](https://github.com/rappasoft/laravel-livewire-tables/pull/285)

### Changed

- [Fix ambiguous column id when using Relation instead of Builder](https://github.com/rappasoft/laravel-livewire-tables/pull/283)
- [Use column text for sorting and filter pills if no $filterNames or $sortNames exist](https://github.com/rappasoft/laravel-livewire-tables/pull/286)
- [Fix tailwind pagination view](https://github.com/rappasoft/laravel-livewire-tables/pull/284)

## [1.6.1] - 2021-05-13

### Changed

- [Allows to use Relation instead of Builder to generate data](https://github.com/rappasoft/laravel-livewire-tables/pull/279)

## [1.6.0] - 2021-05-04

### Added

- Added Unselect All button on bulk row when selecting page.
- Added disabled delay on select checkboxes.
- Added disabled on bulk row button clicks.
- Added missing showPagination conditional to views.
- Added getFilters and getFiltersWithoutSearch methods and refactor views.
- Added checkFilters method and refactor mountWithFilters
- Added hasIntegerKeys method

### Changed

- When selecting a page, if there are the same selected as total rows, just show the amount of selected instead of showing "Selecting 1 row. Do you want to select all 1 rows.".
- Move bulk select row to its own partial for all templates.
- Moved updatedFilters from WithSearch to WithFilters
- Refactor hasFilter to support numeric keys
- Refactor getFilter to support numeric keys
- Refactor getFilterOptions to support numeric keys

### Removed

- Removed updatingFilters from WithFilters

## [1.5.1] - 2021-05-02

### Added

- Added clear search method.

### Changed

- Changed resetAll method to include search and page and moved to parent component.
- Refactored search method to use new resetSearch.
- [Use custom per page on first load](https://github.com/rappasoft/laravel-livewire-tables/pull/270)

## [1.5.0] - 2021-05-02

### Added

- Added hideIf for columns to hide a column with a conditional, works out of the box for cells not using rowView, if using rowView you must wrap the cells you want to hide in the same conditional. [See documentation](https://github.com/rappasoft/laravel-livewire-tables/wiki/Conditionally-hiding-columns).
- Added selected row de-selector when not selecting full page or all.

## [1.4.0] - 2021-04-29

### Added

- Added option for single column sorting only.
- Ability to change empty message per table.
- Added en.json lang file.
- Ability to add 'All' option to per-page.

### Changed

- Modified views to support localization better where necessary (republish views).
- Alphabetize en.json
- Fixed bulk actions using wrong key to select instead of $primaryKey
- Make bulk select checkbox use primary key

## [1.3.1] - 2021-04-26

### Added

- Use the filter option name instead of the value on the filter pills. (https://github.com/rappasoft/laravel-livewire-tables/pull/238)

### Changed

- Added row count when pagination is disabled. (https://github.com/rappasoft/laravel-livewire-tables/pull/239**)
- Fixed whitespace-nowrap in tailwind cell. (https://github.com/rappasoft/laravel-livewire-tables/issues/240)

### Removed

- Removed old readme for the documentation link.

## [1.3.0] - 2021-04-25

### Added

- Added searchable() to columns (https://github.com/rappasoft/laravel-livewire-tables/pull/233)

### Changed

- Fixed offline indicators to display block.
- Tailwind cool-gray to just gray since it is included by default.

## [1.2.2] - 2021-04-23

### Changed

- Removed hard coded bulk text of **users** and changed to **rows**

## [1.2.1] - 2021-04-22

### Changed

- Remove padding from bootstrap container to keep it flush with sides like Tailwind

## [1.2.0] - 2021-04-22

### Added

- Ability to disable pagination (https://github.com/rappasoft/laravel-livewire-tables/pull/222)
- Ability to define the sorting direction names for each column. i.e. A-Z, Z-A, Yes, No, Enabled, Disabled, etc.
- Added ability to define primary key of rows for bulk select
- Added selectedKeys property that returns an array of the ids of the selected rows

### Changed

- Clarified where rowView looks in read me
- Null the search filter when it's empty
- Fill per page options from $perPageAccepted in views
- Make $perPageAccepted public

### Removed

- Removed `text-secondary` class from sorting title

## [1.1.0] - 2021-04-21

### Added

- Added callback to column's sortable() method to customize sorting functionality per column. (https://github.com/rappasoft/laravel-livewire-tables/pull/216)
- Support for polling `keep-alive` and `visible`.
- Start of a test suite (https://github.com/rappasoft/laravel-livewire-tables/pull/218)

### Changed

- Updated Tailwind search clear button (https://github.com/rappasoft/laravel-livewire-tables/pull/217).
- Updated readme

## [1.0.4] - 2021-04-18

### Added

- `$searchFilterDebounce`, `$searchFilterDefer`, `$searchFilterLazy`, for defining the search input data binding property. https://github.com/rappasoft/laravel-livewire-tables/pull/211
- Remove ability to need to define filters if not defining defaults. https://github.com/rappasoft/laravel-livewire-tables/pull/213

### Changed

- Rearrange wire:keys

## [1.0.3] - 2021-04-18

### Added

- Added Bootstrap 5 theme

### Changed

- Removed calls to custom primary color with indigo for tailwind
- Updated search and row click sections of read me to be more clear.
- Added resetPage to per page dropdown and filters.

## [1.0.2] - 2021-04-17

### Changed

- Fixed checkbox click with row click combination following URL and not checking checkbox.

## [1.0.1] - 2021-04-17

### Changed

- Fixed missing bootstrap components aliased to bs4.table.*
- Updated readme
- Added missing row click on bootstrap

## [1.0.0] - 2021-04-16

- Ground up rebuild, see documentation for usage.

## [0.4.0] - 2021-04-14

### Changed

- Fixed polling issue
- Fixed [MongoDB per page issue](https://github.com/rappasoft/laravel-livewire-tables/pull/107)
- [Fixed use of $clearSearchButtonClass variable](https://github.com/rappasoft/laravel-livewire-tables/pull/118)

## [0.3.3] - 2020-12-13

### Added

- PHP8 Support
- Spanish translations
- German translations
- French translations

### Changed

- Updated Arabic translations

## [0.3.2] - 2020-09-25

### Added

- Added thead class to option array
- Ability to export the list set to CSV/XLS/XLSX/PDF
- Ability to mark a visible column as not to be exported
- Ability to mark a column as export only, which hides it from UI
- Ability to format a single column differently for export as it is for its UI
- Added option to change the button class from the config

## [0.3.1] - 2020-09-18

### Changed

- Fixed non-sortable column headers not getting classes applied.
- Updated documentation

## [0.3] - 2020-09-16

- Ground up rebuild

### Added

- Config file to choose frontend framework - currently limited to bootstrap
- Render method to columns which returns whatever you put into it, you can return a view, html, an attribute, etc.
- Pulled in and modified the HTML component library from laravelcollective so you can return html components from the render method. i.e.: $this->image(...);
- Added new loading config on whether to keep displaying the current data while loading or collapse it
- Added ability to set frontend framework specific options via a property on a per component basis.

### Changed

- Extracted the sorting icons out to their actual HTML, so you can use whatever you want, not limited to the 'i' tag.

### Removed

- Checkbox functionality for now
- Component functionality pending debate
- All class and styling based properties. It's better to publish the views to change something.

## [0.2.1] - 2020-09-10

### Added

- Arabic translations
- Ability to add a link to make table rows clickable
- Added the ability to change the sort icons
- Ability to hide a column based on a condition or permanently

### Updated

- Livewire to 2.x

### Removed

- Removed 1 hard coded font awesome icon

### Changed

- Publish tags to service provider

## [0.2.0] - 2020-08-10

### Added

- Add pagination reset for perPage updates
- Add second parameter to view method for the name of the model variable available in the view.
- Allow publishing of views
- Make docblocks work with psalm
- Added searching method either debounce or lazy
- Allow dot notation for customer attributes
- Added loading message to table body if $loadingIndicator is true
- Add clear button option to search box

### Changed

- Updated Livewire to 1.3
- $disableSearchOnLoading default to false
- Trim the search term when processing
- Added language to publishable translation file

### Removed

- Existing loading subview for tbody message

## [0.1.6] - 2020-06-15

### Changed
- Add second parameter to view method for the name of the model variable available in the view.

## [0.1.5] - 2020-05-26

### Changed

- Use constructor instead of mount so that the child classes have access to a mount method that they can accept parameters in.

## [0.1.4] - 2020-05-24

### Changed

- Changed $models to $builder
- Changed callback parameters for sorting to $builder, $direction. (Removed sortField because we know what it is, until someone gives me an example of why it would be beneficial to keep it).

## [0.1.3] - 2020-05-12

### Changed

- Ability to turn off per page option while keeping pagination on
- Fix the search feature if pagination is on, and you're not searching from the first page using Livewire's native resetPage() method.

## [0.1.2] - 2020-04-28

### Changed

- Fixed pagination text when there are zero results

## [0.1.1] - 2020-04-04

### Changed

- Name of table blade view to avoid issues with other like named packages

## 0.1.0 - 2020-04-03

- Initial release

[Unreleased]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.15.0...development
[2.15.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.15.0...v2.14.0
[2.14.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.14.0...v2.13.1
[2.13.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.13.0...v2.13.1
[2.13.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.12.0...v2.13.0
[2.12.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.11.0...v2.12.0
[2.11.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.10.0...v2.11.0
[2.10.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.9.0...v2.10.0
[2.9.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.8.0...v2.9.0
[2.8.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.7.0...v2.8.0
[2.7.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.6.0...v2.7.0
[2.6.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.5.0...v2.6.0
[2.5.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.4.0...v2.5.0
[2.4.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.3.0...v2.4.0
[2.3.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.2.1...v2.3.0
[2.2.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.2.0...v2.2.1
[2.2.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.1.0...v2.2.0
[2.1.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v2.0.0...v2.1.0
[2.0.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.20.1...v2.0.0
[1.21.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.20.1...v1.21.0
[1.20.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.20.0...v1.20.1
[1.20.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.19.3...v1.20.0
[1.19.3]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.19.2...v1.19.3
[1.19.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.19.1...v1.19.2
[1.19.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.18.0...v1.19.1
[1.19.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.18.0...v1.19.0
[1.18.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.17.0...v1.18.0
[1.17.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.16.0...v1.17.0
[1.16.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.15.0...v1.16.0
[1.15.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.14.0...v1.15.0
[1.14.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.13.0...v1.14.0
[1.13.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.12.0...v1.13.0
[1.12.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.11.0...v1.12.0
[1.11.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.10.4...v1.11.0
[1.10.4]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.10.3...v1.10.4
[1.10.3]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.10.2...v1.10.3
[1.10.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.10.1...v1.10.2
[1.10.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.10.0...v1.10.1
[1.10.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.9.0...v1.10.0
[1.9.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.8.0...v1.9.0
[1.8.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.7.1...v1.8.0
[1.7.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.7.0...v1.7.1
[1.7.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.6.1...v1.7.0
[1.6.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.6.0...v1.6.1
[1.6.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.5.1...v1.6.0
[1.5.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.4.0...v1.5.1
[1.5.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.4.0...v1.5.0
[1.4.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.3.1...v1.4.0
[1.3.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.2.2...v1.3.0
[1.2.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.0.4...v1.1.0
[1.0.4]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.0.3...v1.0.4
[1.0.3]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.4.0...v1.0.0
[0.4.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.3.3...v0.4.0
[0.3.3]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.3.2...v0.3.3
[0.3.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.3.1...v0.3.2
[0.3.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.3.0...v0.3.1
[0.3.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.2.1...v0.3.0
[0.2.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.2.0...v0.2.1
[0.2.0]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.6...v0.2.0
[0.1.6]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.5...v0.1.6
[0.1.5]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.4...v0.1.5
[0.1.4]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.3...v0.1.4
[0.1.3]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.2...v0.1.3
[0.1.2]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.1...v0.1.2
[0.1.1]: https://github.com/rappasoft/laravel-livewire-tables/compare/v0.1.0...v0.1.1
