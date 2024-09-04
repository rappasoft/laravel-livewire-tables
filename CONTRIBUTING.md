# Contributing
This package is maintained by a core team, backed by a strong community effort, and contributions are extremely welcome! 

Please find below a brief summary of how to make a good contribution.  This helps to ensure a smooth review and merge of a PR.

## Discussing A Feature
Please do feel free to raise a Discussion topic, a Feature Request Issue, or reach out on the official Discord to discuss any ideas!

## Starting A Contribution
- Always create a fresh branch in your fork for every change.  This should be based on the "development" branch, as other branches may be outdated, or lack the change history.
- Ensure that a PR contains a single feature/fix.  PRs with multiple features often end up with merge conflicts!
- Avoid introducing a breaking change.  If your change makes a radical or substantial change, then the existing behaviour should be maintained as the default.  The core team tracks these, and as major versions are reached, may introduce new default behaviours.

## Generic Information
- Avoid adding any additional dependencies/requirements to the package unless discussed and approved by the core team.
- Typehint both properties and return values
- Add a comment to the method to explain what it does, this does not/should not be lengthy!

## Views
- Where amending/appending to Views/Blades, ensure that you cater for Tailwind, Bootstrap-4 and Bootstrap-5 to ensure continued support

## Tests
- Always add tests for new methods
- Review existing tests if you make changes.
- The project maintains a very high level of test coverage.  A PR that reduces this coverage is less likely to be readily accepted.

## Documentation
There is comprehensive documentation available for existing features.  Please add documentation for any new/amended methods, as otherwise this may result in delays, which may be significant! 

## Conventions
- Please follow the project conventions below:

### Core Features
A feature set typically exists in a "With" trait (For example - Rappasoft\LaravelLivewireTables\Traits\WithColumns.php)
- The "WithColumns" contains any properties, and any key methods
- Each feature set has a "Helper" and "Configuration" trait associated with it, for setting and getting properties, both server-side, and client-side.

## Actions, Columns and Filters
An Action/Column/Filter type exists in the "Views" section (For example Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn.php)
- Each Action/Column/Filter again has a "Helper" and "Configuration" trait associated with it, for setting and getting properties
- Actions should extend Rappasoft\LaravelLivewireTables\Views\Action (or a class that extends this)
- Columns should extend Rappasoft\LaravelLivewireTables\Views\Column (or a class that extends this)
- Filters should extend Rappasoft\LaravelLivewireTables\Views\Filter (or a class that extends this)

