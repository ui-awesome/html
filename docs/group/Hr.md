# Hr

The `<hr>` `HTML` element represents a thematic break between paragraph-level elements: for example, a change of scene
in a story, or a shift of topic within a section.

## Basic Usage

Instantiate the `Hr` class using `Hr::widget()`.

```php
$hr = Hr::widget();
```

## Setting Attributes

Use the provided methods to set specific attributes for the a element.

```php
// setting class attribute
$hr->class('container');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$hr->attributes(['class' => 'container', 'style' => 'background-color: #eee;']);
```

## Rendering

Generate the `HTML` output using the `render` method, for simple instantiation. 

```php
$hr = $hr->render();
```

Or, use the magic `__toString` method.

```php
$html = (string) $hr;
```

## Attributes

Refer to the [Attribute Tests](https://github.com/ui-awesome/html/blob/main/tests/Group/Hr/AttributeTest.php) for
comprehensive examples.

The following methods are available for setting attributes:

| Method            | Description                                                                                      |
| ----------------- | ------------------------------------------------------------------------------------------------ |
| `attributes()`    | Set multiple `attributes` at once.                                                               |
| `class()`         | Set the `class` attribute.                                                                       |
| `size()`          | Set the `size` attribute.                                                                        |
| `width()`         | Set the `width` attribute.                                                                       |

## Custom methods

Refer to the [Custom Methods Tests](https://github.com/ui-awesome/html/blob/main/tests/Group/Hr/CustomMethodTest.php)
for comprehensive examples.

The following methods are available for customizing the `HTML` output:

| Method                       | Description                                                                           |
| Method                       | Description                                                                           |
| ---------------------------- | ------------------------------------------------------------------------------------- |
| `render()`                   | Generates the `HTML` output.                                                          |
| `widget()`                   | Instantiates the `Hr::class`.                                                         |

