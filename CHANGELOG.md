# ChangeLog

## 0.4.0 Under development

- Enh #17: Refactor codebase to improve performance (@terabytesoftw)
- Enh #18: Add `Dl`, `Dt`, and `Dd` class tag for list support (@terabytesoftw)
- Enh #19: Add `InputWeek` class for HTML `<input type="week">` element with attributes and rendering capabilities (@terabytesoftw)
- Bug #20: Standardize PHPDoc headers and usage examples across core HTML elements in `src` directory (@terabytesoftw)
- Bug #21: Standardize PHPDoc headers in `tests` directory (@terabytesoftw)
- Enh #22: Add `InputUrl` class for HTML `<input type="url">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #23: Add `InputTime` class for HTML `<input type="time">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #24: Add `InputText` class for HTML `<input type="text">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #25: Add `InputTel` class for HTML `<input type="tel">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #26: Add `InputSubmit` class for HTML `<input type="submit">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #27: Add `InputSearch` class for HTML `<input type="search">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #28: Add `InputReset` class for HTML `<input type="reset">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #29: Add `InputRange` class for HTML `<input type="range">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #30: Add `InputPassword` class for HTML `<input type="password">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #31: Add `InputCheckbox` class for HTML `<input type="checkbox">` element with attributes and rendering capabilities (@terabytesoftw)
- Bug #32: Update parameter descriptions to clarify usage for form attributes and input elements (@terabytesoftw)
- Enh #33: Add `Label` class for HTML `<label>` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #34: Add `InputHidden` class for HTML `<input type="hidden">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #35: Add `InputRadio` class for HTML `<input type="radio">` element with attributes and rendering capabilities (@terabytesoftw)
- Enh #36: Add `InputNumber` class for HTML `<input type="number">` element with attributes and rendering capabilities (@terabytesoftw)
- Bug #37: Apply last changes from `ui-awesome/html-core` package to `ui-awesome/html` package (@terabytesoftw)
- Bug #38: Remove redundant `afterRun()` method from `Dl`, `Ol`, and `Ul` classes (@terabytesoftw)
- Enh #39: Add `InputMonth` class for HTML `<input type="month">` element with attributes and rendering capabilities (@terabytesoftw)
- Bug #40: Refactor tests to use `assertSame()` for rendering with `testRenderWithGlobalDefaultsAreApplied()` and `testRenderWithUserOverridesGlobalDefaults()` (@terabytesoftw)
- Enh #41: Add `InputImage` class for HTML `<input type="image">` element with attributes and rendering capabilities (@terabytesoftw)
- Bug #42: Fix messages in `assert()` methods and code style (@terabytesoftw)
- Bug #43: Update `ui-awesome/html-helper` to version `^0.7` and `ui-awesome/html-mixin` to version `^0.4` in `composer.json` and apply necessary changes to `src` and `tests` directories (@terabytesoftw)
- Bug #44: Update last modified from `ui-awesome/html-attribute` in related classes (@terabytesoftw)
- Bug #45: Better naming for `CanBeUnchecked` to `HasUnchecked` and update phpdoc `BaseChoice` classes (@terabytesoftw)
- Enh #46: Add `InputFile` class for HTML `<input type="file">` element with attributes and rendering capabilities (@terabytesoftw)

## 0.3.0 March 31, 2024

- Enh #15: Move `Tag` class widget, `AbstractElement` class, and `AbstractBlockElement` class to `ui-awesome/html-core` package (@terabytesoftw)

## 0.2.0 March 22, 2024

- Enh #14: Move `Svg` class widget to `ui-awesome/html-svg` package (@terabytesoftw)

## 0.1.3 March 19, 2024

- Bug #11: Fix broken links in `docs` (@terabytesoftw)
- Enh #12: Add `CheckboxList` and `RadioList` class widgets (@terabytesoftw)
- Bug #13: Add tests for `CheckboxList` and `RadioList` class for validate attributes (@terabytesoftw)

## 0.1.2 March 15, 2024

- Bug #9: Fix broken links in `Div`, `Li`, `Ol`, `P`, and `Ul` documentation (@terabytesoftw)
- Enh #10: Add `Hr` class widget (@terabytesoftw)

## 0.1.1 March 8, 2024

- Bug #6: Remove generate ID in `UIAwesome\Html\FormControl\Button` class (@terabytesoftw)
- Bug #7: Add `Html\Interop\RenderInterface::class` all classes (@terabytesoftw)
- Bug #8: Change branch alias to `1.0-dev` in `composer.json` (@terabytesoftw)

## 0.1.0 March 6, 2024

- Initial release.
- Bug #2: Refactor `README.md` to improve organization and headings for better readability (@terabytesoftw)
- Bug #3: Update badges in `README.md` (@terabytesoftw)
- Enh #4: Move `Builder::class` to `ui-awesome/html-helper` (@terabytesoftw)
