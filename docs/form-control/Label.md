# Label

The `<label>` `HTML` element represents a caption for an item in a user interface.

## Basic Usage

Instantiate the `Label` class using `Label::widget()`.

```php
$label = Label::widget();
```

## Setting Attributes

Use the provided methods to set specific attributes for the a element.

```php
// setting class attribute
$label->class('text-primary');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$label->attributes(['class' => 'text-primary', 'title' => 'Home']);
```

## Adding Content

If you want to include content within the `label` tag, use the `content` method.

```php
$label->content('MyContent');
```

> if content is empty, the `label` tag will not be rendered.


## Rendering

Generate the `HTML` output using the `render` method.

```php
$html = $label->render();
```

Or, use the magic `__toString` method.

```php
$html = (string) $label;
```

## Common Use Cases

Below are examples of common use cases:

```php
// adding multiple attributes
$label->class('text-primary')->title('Home');

// using data attributes
$label->dataAttributes(['bs-toggle' => 'modal', 'bs-target' => '#exampleModal', 'analytics' => 'trackClick']);
```

Explore additional methods for setting various attributes such as `for`, `form`, `lang`, `tabindex`, `title`, and more.

## Prefix and Suffix

Use `prefix` and `suffix` methods to add text before and after the `label` tag, respectively.

```php
// adding a prefix
$html = $label->content('MyContent')->prefix('MyPrefix')->render();

// adding a suffix
$html = $label->content('MyContent')->suffix('MySuffix')->render();
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
$label->template('<span>{tag}</span>');
```

## Attributes

Refer to the [Attribute Tests](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Label/AttributeTest.php)
for comprehensive examples.

The following methods are available for setting attributes:

| Method            | Description                                                                                      |
| ----------------- | ------------------------------------------------------------------------------------------------ |
| `attributes()`    | Set multiple `attributes` at once.                                                               |
| `class()`         | Set the `class` attribute.                                                                       |
| `content()`       | Set the `content` within the `label` element.                                                    |
| `dataAttributes()`| Set multiple `data-attributes` at once.                                                          |
| `for()`           | Set the `for` attribute.                                                                         |
| `form()`          | Set the `form` attribute.                                                                        |
| `id()`            | Set the `id` attribute.                                                                          |
| `lang()`          | Set the `lang` attribute.                                                                        |
| `name()`          | Set the `name` attribute.                                                                        |
| `style()`         | Set the `style` attribute.                                                                       |
| `title()`         | Set the `title` attribute.                                                                       |

## Custom methods

Refer to the [Custom Method Test](https://github.com/ui-awesome/html/blob/main/tests/FormControl/Label/CustomMethodTest.php)
for comprehensive examples.

The following methods are available for customizing the `HTML` output:

| Method                       | Description                                                                           |
| ---------------------------- | ------------------------------------------------------------------------------------- |
| `prefix()`                   | Add text before the `tag` element. If empty, the `prefix` tag will be disabled.       |
| `prefixAttributes()`         | Set `attributes` for the `prefix` element.                                            |
| `prefixClass()`              | Set the `class` attribute for the `prefix` element.                                   |
| `prefixTag()`                | Set the `tag` for the `prefix` element.                                               |
|                              | If `false` the prefix tag will be disabled.                                           |
| `render()`                   | Generates the `HTML` output.                                                          |
| `suffix()`                   | Add text after the `tag` element. If empty, the `suffix` tag will be disabled.        |
| `suffixAttributes()`         | Set `attributes` for the `suffix` element.                                            |
| `suffixClass()`              | Set the `class` attribute for the `suffix` element.                                   |
| `suffixTag()`                | Set the `tag` for the `suffix-container` element.                                     |
|                              | If `false` the suffix tag will be disabled.                                           |
| `template()`                 | Set the `template` for the `label` element.                                           |
| `widget()`                   | Instantiates the `Label::class`.                                                      |
