# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 0.4.0 Under development

- perf: Refactor codebase to improve performance.
- feat(list): Add `Dl`, `Dt`, and `Dd` classes for description list elements.
- feat(form): Add `InputWeek` class for `<input type="week">` element.
- docs: Standardize PHPDoc headers and usage examples in `src/`.
- docs: Standardize PHPDoc headers in `tests/`.
- feat(form): Add `InputUrl` class for `<input type="url">` element.
- feat(form): Add `InputTime` class for `<input type="time">` element.
- feat(form): Add `InputText` class for `<input type="text">` element.
- feat(form): Add `InputTel` class for `<input type="tel">` element.
- feat(form): Add `InputSubmit` class for `<input type="submit">` element.
- feat(form): Add `InputSearch` class for `<input type="search">` element.
- feat(form): Add `InputReset` class for `<input type="reset">` element.
- feat(form): Add `InputRange` class for `<input type="range">` element.
- feat(form): Add `InputPassword` class for `<input type="password">` element.
- feat(form): Add `InputCheckbox` class for `<input type="checkbox">` element.
- docs(form): Clarify parameter descriptions for form attributes and input elements.
- feat(form): Add `Label` class for `<label>` element.
- feat(form): Add `InputHidden` class for `<input type="hidden">` element.
- feat(form): Add `InputRadio` class for `<input type="radio">` element.
- feat(form): Add `InputNumber` class for `<input type="number">` element.
- fix: Apply latest changes from `ui-awesome/html-core` package.
- refactor(list): Remove redundant `afterRun()` method from `Dl`, `Ol`, and `Ul` classes.
- feat(form): Add `InputMonth` class for `<input type="month">` element.
- test: Use `assertSame()` in rendering tests for global defaults and user overrides.
- feat(form): Add `InputImage` class for `<input type="image">` element.
- fix: Fix messages in `assert()` methods and code style.
- build: Update `ui-awesome/html-helper` to `^0.7` and `ui-awesome/html-mixin` to `^0.4`.
- fix: Sync changes from `ui-awesome/html-attribute` in related classes.
- refactor: Rename `CanBeUnchecked` to `HasUnchecked` and update PHPDoc in `BaseChoice` classes.
- feat(form): Add `InputFile` class for `<input type="file">` element.
- docs(test): Update PHPDoc in tests and add tests for `on*` attributes.
- feat(form): Add `InputEmail` class for `<input type="email">` element.
- feat(form): Add `InputDateTimeLocal` class for `<input type="datetime-local">` element.
- test: Standardize test cases for clarity and consistency.
- feat(form): Add `InputDate` class for `<input type="date">` element.
- feat(form): Add `InputColor` class for `<input type="color">` element.
- feat(form): Add `TextArea` class for `<textarea>` element.
- refactor(test): Standardize exception test method names.
- refactor(form): Remove `BaseChoice` class and related mixins; update `InputCheckbox`, `InputFile`, and `InputRadio` to extend `BaseInput`.
- feat(form): Add `Button` class for `<button>` element.
- test: Add tests for invalid argument exceptions in HTML attributes.
- feat(form): Add `Form` class for `<form>` element.
- fix: Align tag enums and defaults provider with latest `ui-awesome/html-core` and `ui-awesome/html-interop` changes.
- refactor(test): Remove `aria-describedby` specific form input tests to keep the package agnostic.
- feat(form): Add `Select`, `Option`, and `Optgroup` classes for `<select>`, `<option>`, and `<optgroup>` elements.
- feat(form): Add `Datalist` class for `<datalist>` element.
- feat(form): Add `Legend` class for `<legend>` element.
- feat(form): Add `Fieldset` class for `<fieldset>` element.
- feat(form): Add `Output` class for `<output>` element.
- feat(form): Add `Progress` class for `<progress>` element.
- feat(form): Add `Meter` class for `<meter>` element.
- feat(table): Add `Caption` class for `<caption>` element.
- feat(table): Add `Td` class for `<td>` element.
- feat(table): Add `Th` class for `<th>` element.
- feat(table): Add `Tr` class for `<tr>` element.
- feat(table): Add `Tfoot` class for `<tfoot>` element.
- feat(table): Add `Tbody` class for `<tbody>` element.
- feat(table): Add `Thead` class for `<thead>` element.
- feat(table): Add `Col` class for `<col>` element.
- feat(table): Add `Colgroup` class for `<colgroup>` element.
- feat(table): Add convenience methods `row()`, `rows()` on `Thead`, `Tbody`, `Tfoot`; `cells()`, `headerCells()` on `Tr`; extend `caption()` in `Table` to accept `Caption|string|null`.
- fix(list): Fix PHPDoc `Usage example` placement in `Dl::dd()` and `Dl::dt()` to appear before tags.
- feat(list): Extend `Dl::dd()` to accept `Dd|string|Stringable` and `Dl::dt()` to accept `Dt|string|Stringable` for API consistency.
- feat(list): Add `Dl::terms()` batch method for appending multiple term-description pairs.
- feat(form): Add `Select::options()` convenience method for appending multiple options from value-label pairs.
- feat(table): Add `Colgroup::cols()` batch method for appending multiple `Col` elements.
- feat(interactive): Add `Summary` class for `<summary>` element.
- feat(interactive): Add `Details` class for `<details>` element.
- feat(interactive): Add `Dialog` class for `<dialog>` element.

## 0.3.0 March 31, 2024

- refactor: Move `Tag` class widget, `AbstractElement` class, and `AbstractBlockElement` class to `ui-awesome/html-core` package.

## 0.2.0 March 22, 2024

- refactor: Move `Svg` class widget to `ui-awesome/html-svg` package.

## 0.1.3 March 19, 2024

- fix(docs): Fix broken links in docs.
- feat: Add `CheckboxList` and `RadioList` class widgets.
- test: Add tests for `CheckboxList` and `RadioList` to validate attributes.

## 0.1.2 March 15, 2024

- fix(docs): Fix broken links in `Div`, `Li`, `Ol`, `P`, and `Ul` documentation.
- feat: Add `Hr` class widget.

## 0.1.1 March 8, 2024

- fix(form): Remove auto-generated ID in `UIAwesome\Html\FormControl\Button` class.
- fix: Add `Html\Interop\RenderInterface` to all classes.
- fix(build): Change branch alias to `1.0-dev` in `composer.json`.

## 0.1.0 March 6, 2024

- Initial release.
- fix(docs): Improve `README.md` organization and headings for better readability.
- fix(docs): Update badges in `README.md`.
- refactor: Move `Builder::class` to `ui-awesome/html-helper`.
