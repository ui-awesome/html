# Range

The input element with a type attribute whose value is `range` represents an imprecise control for setting the element’s
value to a string representing a number.

## Basic Usage

Instantiate the `Range` class using `Range::widget()`.

```php
$range = Range::widget();
```

## Generate field id and name

The `fieldAttributes` method is used to generate the field id and name for the `HTML` output.

Allowed arguments are:

- `formModel` - The name of the model.
- `property` - The name of the field.

```php
// generate field id and name
$range->fieldAttributes('model', 'field');
```

## Setting Attributes

Use the provided methods to set specific attributes for the a element.

```php
// setting class attribute
$range->class('container');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$range->attributes(['class' => 'container', 'style' => 'background-color: #eee;']);
```

## Adding value

If you want to include value in the `range` element, use the `value` method.

```php
$range->value('MyValue');
```

## Rendering

Generate the `HTML` output using the `render` method, for simple instantiation. 

```php
$html = $range->render();
```

Or, use the magic `__toString` method.

```php
$html = (string) $range;
```

## Common use cases

Below are examples of common use cases:

```php
// adding multiple attributes
$range->class('external')->value('Myvalue');

// using data attributes
$range->dataAttributes(['analytics' => 'trackClick']);
```

Explore additional methods for setting various attributes such as `lang`, `name`, `style`, `step`, `title`, etc.

## Prefix and Suffix

Use `prefix` and `suffix` methods to add text before and after the `range` tag, respectively.

```php
// adding a prefix
$html = $range->value('MyValue')->prefix('MyPrefix')->render();

// adding a suffix
$html = $range->value('MyValue')->suffix('MySuffix')->render();
```

## Template

The `template` method allows you to customize the `HTML` output of the a element.

The following template tags are available:

| Tag        | Description      |
| ---------- | ---------------- |
| `{prefix}` | The prefix text. |
| `{tag}`    | The a element.   |
| `{suffix}` | The suffix text. |

```php
// using a custom template
$range->template('<div>{tag}</div>');
```

## Attributes

Refer to the [Attribute Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/Range/AttributeTest.php)
for comprehensive examples.

The following methods are available for setting attributes:

| Method             | Description                                                                                     |
| ------------------ | ----------------------------------------------------------------------------------------------- |
| `ariaDescribedBy()`| Set the `aria-describedby` attribute.                                                           |
| `ariaLabel()`      | Set the `aria-label` attribute.                                                                 |
| `attributes()`     | Set multiple `attributes` at once.                                                              |
| `autocomplete()`   | Set the `autocomplete` attribute.                                                               |
| `autofocus()`      | Set the `autofocus` attribute.                                                                  |
| `class()`          | Set the `class` attribute.                                                                      |
| `dataAttributes()` | Set multiple `data-attributes` at once.                                                         |
| `dirname()`        | Set the `dirname` attribute.                                                                    |
| `disabled()`       | Set the `disabled` attribute.                                                                   |
| `form()`           | Set the `form` attribute.                                                                       |
| `hidden()`         | Set the `hidden` attribute.                                                                     |
| `id()`             | Set the `id` attribute.                                                                         |
| `lang()`           | Set the `lang` attribute.                                                                       |
| `name()`           | Set the `name` attribute.                                                                       |
| `readOnly()`       | Set the `readonly` attribute.                                                                   |
| `style()`          | Set the `style` attribute.                                                                      |
| `tabIndex()`       | Set the `tabindex` attribute.                                                                   |
| `title()`          | Set the `title` attribute.                                                                      |
| `value()`          | Set the `value` attribute.                                                                      |

## Custom methods

Refer to the [Custom Methods Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/Range/CustomMethodTest.php) 
for comprehensive examples.

The following methods are available for customizing the `HTML` output:

| Method                       | Description                                                                           |
| ---------------------------- | ------------------------------------------------------------------------------------- |
| `fieldAttributes()`          | Generate the field id and name for the `HTML` output.                                 |
| `prefix()`                   | Add text before the `input` element. If empty, the `prefix` tag will be disabled.     |
| `prefixAttributes()`         | Set `attributes` for the `prefix` element.                                            |
| `prefixClass()`              | Set the `class` attribute for the `prefix` element.                                   |
| `prefixTag()`                | Set the `tag` for the `prefix` element.                                               |
|                              | If `false` the prefix tag will be disabled.                                           |
| `render()`                   | Generates the `HTML` output.                                                          |
| `suffix()`                   | Add text after the `input` element. If empty, the `suffix` tag will be disabled.      |
| `suffixAttributes()`         | Set `attributes` for the `suffix` element.                                            |
| `suffixClass()`              | Set the `class` attribute for the `suffix` element.                                   |
| `suffixTag()`                | Set the `tag` for the `suffix-container` element.                                     |
|                              | If `false` the suffix tag will be disabled.                                           |
| `template()`                 | Set the template for the `HTML` output.                                               |
| `widget()`                   | Instantiates the `Range::class`.                                                      |

## Validate methods

Refer to the [Validate Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/Range/ValidateTest.php)
for comprehensive examples.

| Method  | Description                                                                                                |
| ------- | ---------------------------------------------------------------------------------------------------------- |
| `max()` | Set the `max` attribute.                                                                                   |
| `min()` | Set the `min` attribute.                                                                                   |
| `step()`| Set the `step` attribute.                                                                                  |
