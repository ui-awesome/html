# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 0.4.0 Under development

- perf: refactor codebase to improve performance.
- feat(list): add `Dl`, `Dt`, and `Dd` classes for description list elements.
- feat(form): add `InputWeek` class for `<input type="week">` element.
- docs: standardize PHPDoc headers and usage examples in `src/`.
- docs: standardize PHPDoc headers in `tests/`.
- feat(form): add `InputUrl` class for `<input type="url">` element.
- feat(form): add `InputTime` class for `<input type="time">` element.
- feat(form): add `InputText` class for `<input type="text">` element.
- feat(form): add `InputTel` class for `<input type="tel">` element.
- feat(form): add `InputSubmit` class for `<input type="submit">` element.
- feat(form): add `InputSearch` class for `<input type="search">` element.
- feat(form): add `InputReset` class for `<input type="reset">` element.
- feat(form): add `InputRange` class for `<input type="range">` element.
- feat(form): add `InputPassword` class for `<input type="password">` element.
- feat(form): add `InputCheckbox` class for `<input type="checkbox">` element.
- docs(form): clarify parameter descriptions for form attributes and input elements.
- feat(form): add `Label` class for `<label>` element.
- feat(form): add `InputHidden` class for `<input type="hidden">` element.
- feat(form): add `InputRadio` class for `<input type="radio">` element.
- feat(form): add `InputNumber` class for `<input type="number">` element.
- fix: apply latest changes from `ui-awesome/html-core` package.
- refactor(list): remove redundant `afterRun()` method from `Dl`, `Ol`, and `Ul` classes.
- feat(form): add `InputMonth` class for `<input type="month">` element.
- test: use `assertSame()` in rendering tests for global defaults and user overrides.
- feat(form): add `InputImage` class for `<input type="image">` element.
- fix: fix messages in `assert()` methods and code style.
- build: update `ui-awesome/html-helper` to `^0.7` and `ui-awesome/html-mixin` to `^0.4`.
- fix: sync changes from `ui-awesome/html-attribute` in related classes.
- refactor: rename `CanBeUnchecked` to `HasUnchecked` and update PHPDoc in `BaseChoice` classes.
- feat(form): add `InputFile` class for `<input type="file">` element.
- docs(test): update PHPDoc in tests and add tests for `on*` attributes.
- feat(form): add `InputEmail` class for `<input type="email">` element.
- feat(form): add `InputDateTimeLocal` class for `<input type="datetime-local">` element.
- test: add tests for standardized test cases for clarity and consistency.
- feat(form): add `InputDate` class for `<input type="date">` element.
- feat(form): add `InputColor` class for `<input type="color">` element.
- feat(form): add `TextArea` class for `<textarea>` element.
- refactor(test): standardize exception test method names.
- refactor(form): remove `BaseChoice` class and related mixins; update `InputCheckbox`, `InputFile`, and `InputRadio` to extend `BaseInput`.
- feat(form): add `Button` class for `<button>` element.
- test: add tests for invalid argument exceptions in HTML attributes.
- feat(form): add `Form` class for `<form>` element.
- fix: align tag enums and defaults provider with latest `ui-awesome/html-core` and `ui-awesome/html-interop` changes.
- refactor(test): remove `aria-describedby` specific form input tests to keep the package agnostic.
- feat(form): add `Select`, `Option`, and `Optgroup` classes for `<select>`, `<option>`, and `<optgroup>` elements.
- feat(form): add `Datalist` class for `<datalist>` element.
- feat(form): add `Legend` class for `<legend>` element.
- feat(form): add `Fieldset` class for `<fieldset>` element.
- feat(form): add `Output` class for `<output>` element.
- feat(form): add `Progress` class for `<progress>` element.
- feat(form): add `Meter` class for `<meter>` element.
- feat(table): add `Caption` class for `<caption>` element.
- feat(table): add `Td` class for `<td>` element.
- feat(table): add `Th` class for `<th>` element.
- feat(table): add `Tr` class for `<tr>` element.
- feat(table): add `Tfoot` class for `<tfoot>` element.
- feat(table): add `Tbody` class for `<tbody>` element.
- feat(table): add `Thead` class for `<thead>` element.
- feat(table): add `Col` class for `<col>` element.
- feat(table): add `Colgroup` class for `<colgroup>` element.
- feat(table): add convenience methods `row()`, `rows()` on `Thead`, `Tbody`, `Tfoot`; `cells()`, `headerCells()` on `Tr`; extend `caption()` in `Table` to accept `Caption|string|null`.
- fix(list): fix PHPDoc `Usage example` placement in `Dl::dd()` and `Dl::dt()` to appear before tags.
- feat(list): extend `Dl::dd()` to accept `Dd|string|Stringable` and `Dl::dt()` to accept `Dt|string|Stringable` for API consistency.
- feat(list): add `Dl::terms()` batch method for appending multiple term-description pairs.
- feat(form): add `Select::options()` convenience method for appending multiple options from value-label pairs.
- feat(table): add `Colgroup::cols()` batch method for appending multiple `Col` elements.
- feat(interactive): add `Summary` class for `<summary>` element.
- feat(interactive): add `Details` class for `<details>` element.
- feat(interactive): add `Dialog` class for `<dialog>` element.
- feat(embedded): add `Audio` class for `<audio>` element.
- feat(embedded): add `Video` class for `<video>` element.
- docs: complete missing MDN links and mark experimental HTML attributes in PHPDoc.
- feat(embedded): add `Source` class for `<source>` element.

## 0.3.0 March 31, 2024

- refactor: move `Tag` class widget, `AbstractElement` class, and `AbstractBlockElement` class to `ui-awesome/html-core` package.

## 0.2.0 March 22, 2024

- refactor: move `Svg` class widget to `ui-awesome/html-svg` package.

## 0.1.3 March 19, 2024

- fix(docs): fix broken links in docs.
- feat: add `CheckboxList` and `RadioList` class widgets.
- test: add tests for `CheckboxList` and `RadioList` to validate attributes.

## 0.1.2 March 15, 2024

- fix(docs): fix broken links in `Div`, `Li`, `Ol`, `P`, and `Ul` documentation.
- feat: add `Hr` class widget.

## 0.1.1 March 8, 2024

- fix(form): remove auto-generated ID in `UIAwesome\Html\FormControl\Button` class.
- fix: add `Html\Interop\RenderInterface` to all classes.
- fix(build): change branch alias to `1.0-dev` in `composer.json`.

## 0.1.0 March 6, 2024

- Initial release.
- fix(docs): improve `README.md` organization and headings for better readability.
- fix(docs): update badges in `README.md`.
- refactor: move `Builder::class` to `ui-awesome/html-helper`.
