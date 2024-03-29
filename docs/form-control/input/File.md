# File

The input element with a type attribute whose value is `file` represents a list of file items, each consisting of a file
name, a file type, and a file body (the contents of the file).

## Basic Usage

Instantiate the `File` class using `File::widget()`.

```php
$file = File::widget();
```

## Generate field id and name

The `fieldAttributes` method is used to generate the field id and name for the `HTML` output.

Allowed arguments are:

- `formModel` - The name of the model.
- `property` - The name of the field.

```php
// generate field id and name
$file->fieldAttributes('model', 'field');
```

## Setting Attributes

Use the provided methods to set specific attributes for the a element.

```php
// setting class attribute
$file->class('container');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$file->attributes(['class' => 'container', 'style' => 'background-color: #eee;']);
```

## Adding value

If you want to include value in the `file` element, use the `value` method.

```php
$file->value('MyValue');
```

## Rendering

Generate the `HTML` output using the `render` method, for simple instantiation. 

```php
$html = $file->render();
```

Or, use the magic `__toString` method.

```php
$html = (string) $file;
```

## Common use cases

Below are examples of common use cases:

```php
// adding multiple attributes
$file->class('external')->value('Myvalue');

// using data attributes
$file->dataAttributes(['analytics' => 'trackClick']);
```

Explore additional methods for setting various attributes such as `accept`, `lang`, `multiple`, `name`, `style`,
`title`, etc.

## Prefix and Suffix

Use `prefix` and `suffix` methods to add text before and after the `file` tag, respectively.

```php
// adding a prefix
$html = $file->value('MyValue')->prefix('MyPrefix')->render();

// adding a suffix
$html = $file->value('MyValue')->suffix('MySuffix')->render();
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
$file->template('<div>{tag}</div>');
```

## Attributes

Refer to the [Attribute Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/File/AttributeTest.php)
for comprehensive examples.

The following methods are available for setting attributes:

| Method             | Description                                                                                     |
| ------------------ | ----------------------------------------------------------------------------------------------- |
| `ariaDescribedBy()`| Set the `aria-describedby` attribute.                                                           |
| `ariaLabel()`      | Set the `aria-label` attribute.                                                                 |
| `attributes()`     | Set multiple `attributes` at once.                                                              |
| `autofocus()`      | Set the `autofocus` attribute.                                                                  |
| `class()`          | Set the `class` attribute.                                                                      |
| `dataAttributes()` | Set multiple `data-attributes` at once.                                                         |
| `disabled()`       | Set the `disabled` attribute.                                                                   |
| `form()`           | Set the `form` attribute.                                                                       |
| `hidden()`         | Set the `hidden` attribute.                                                                     |
| `id()`             | Set the `id` attribute.                                                                         |
| `lang()`           | Set the `lang` attribute.                                                                       |
| `multiple()`       | Set the `multiple` attribute.                                                                   |
| `name()`           | Set the `name` attribute.                                                                       |
| `readOnly()`       | Set the `readonly` attribute.                                                                   |
| `style()`          | Set the `style` attribute.                                                                      |
| `tabIndex()`       | Set the `tabindex` attribute.                                                                   |
| `title()`          | Set the `title` attribute.                                                                      |

## Custom methods

Refer to the [Custom Methods Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/File/CustomMethodTest.php)
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
| `uncheckAttributes()`        | Set the attributes for the hidden input tag.                                          |
| `uncheckClass()`             | Set the `class` attribute for the hidden input tag.                                   |
| `uncheckValue()`             | Set the `value` attribute for the hidden input tag.                                   |
| `widget()`                   | Instantiates the `File::class`.                                                       |

## Validate methods

Refer to the [Validate Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Input/File/ValidateTest.php)
for comprehensive examples.

| Method      | Description                                                                                            |
| ----------- | ------------------------------------------------------------------------------------------------------ |
| `accept()`  | Set the `accept` attribute.                                                                            |
| `required()`| Set the `required` attribute.                                                                          |
