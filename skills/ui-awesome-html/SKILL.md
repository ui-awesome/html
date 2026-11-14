---
name: ui-awesome-html
description: Use when composing typed, immutable HTML elements and form controls with ui-awesome/html in PHP applications. Not for sanitizing untrusted HTML, validating URLs or scripts, Yii widgets, database models or frontend asset management.
license: BSD-3-Clause
---

# Work with typed HTML element composition

## Resolve the actual package

Inspect the installed package path, reference and PHP constraint before choosing an API. Compare Composer installed
metadata, the lockfile and actual source; modified/path repositories may differ from a published revision. A skill installation does not install runtime dependencies.

Start with `src/Html.php` and only the related source, tests and guide needed for the task. Guides may be excluded from
Composer archives: use the installed source or matching-revision repository documentation, not an assumed latest API.
Do not use this package as a substitute for unrelated Yii widgets, database models or frontend asset management.

## Package-specific workflow

- Choose concrete elements from their semantic namespaces, such as `Flow\Div`, `Phrasing\Span`, or the relevant form-control class. The `Html` facade has factories only for common tags plus `Html::el()` for a one-off string; any other element comes from its own class.

- Create immutable elements with `::tag()`, assign returned instances and render explicitly. `content()` encodes text; `html()` accepts trusted raw markup. Encoding does not validate URL schemes, event handlers or CSS.

- Inspect inherited implementation in html-core, traits in html-mixin and typed setters in html-attribute at their installed revisions. A root package constraint does not prove which implementation was loaded.

- For form controls, verify optional capabilities and submitted values. Test explicit empty values, zero, enum values and boolean attributes; keep browser behavior separate from PHP markup generation.

## Preserve package contracts

These outputs are intended; assert against them instead of "fixing" the markup.

- Every setter returns a new instance. A base element reused after `content()` or `checked()` still renders its
  original state.
- Block elements render their content on its own lines: `Div::tag()->render()` is `"<div>\n</div>"`. `Pre` and
  `TextArea` render content inline instead, adding one newline after the opening tag only when the content is empty or
  starts with `\n` or `\r`, so a leading newline survives HTML parsing: `content('value')` renders `<pre>value</pre>`
  and `content("\nX")` renders `"<pre>\n\nX</pre>"`. `Pre` also skips line-break normalization.
- `Html::el()` encodes its content and throws `InvalidArgumentException` for a tag name outside the known tag enums.
- Checkbox and radio inputs without `value` are matched against `on`, the value browsers submit; the `value`
  attribute stays omitted. A boolean `value` renders as `1` or `0`.
- Once `checked()` is called, it replaces a raw `checked` attribute: `checked(false)` and `checked(null)` both remove it.
  Without a `checked()` call, a raw `checked` attribute is kept.
- `InputFile` drops any `value` attribute and appends `[]` to a non-empty name when `multiple(true)` is set.
- `CheckboxList` names its inputs `name[]`, `RadioList` keeps `name`, and `uncheckedValue()` adds a hidden input with
  the unsuffixed name before the items.
- `Select::value()` validates on render: without `multiple`, an array may contain at most one item; with
  `multiple(true)`, a non-null value must be an array. Invalid combinations throw `InvalidArgumentException`.

## Verify the result

Execute focused examples against the inspected package and its actual dependencies. Assert normal, boundary and negative
cases with explicit failures; do not rely on disabled PHP assertions. Preserve supported PHP versions and report missing
runtime/tooling rather than changing constraints to manufacture a pass. Report which results you executed and which you
only read. Do not install dependencies or modify unrelated files without an authorized task.
