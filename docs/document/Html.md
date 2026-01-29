# Html

The `<html>` `HTML` element represents the root (top-level element) of an HTML document, so it is also referred to as
the root element. All other elements must be descendants of this element.

## Basic Usage

Instantiate the `Html` class using `Html::tag()`.

```php
$html = Html::tag();
```

Or, block style instantiation.

```php
<?= Html::tag()->begin() ?>
    // ... content to be wrapped by `html` element
<?= Html::end() ?>
```

## Setting Attributes

Use the provided methods to set global attributes for the element.

```php
// setting class attribute
$html->class('container');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$html->attributes(['class' => 'container', 'style' => 'background-color: #eee;']);
```

## Adding Content

If you want to include content within the `html` tag, use the `content` method.

```php
$html->content('MyContent');
```

Or, use `begin()` and `end()` methods to wrap content.

```php
<?= Html::tag()->begin() ?>
    My content
<?= Html::end() ?>
```

## Rendering

Generate the `HTML` output using the `render` method, for simple instantiation. 

```php
$html = $html->render();
```

For block style instantiation, use the `end()` method, which returns the `HTML` output.

```php
$html = Html::end();
```

Or, use the magic `__toString` method.

```php
$html = (string) $html;
```

## Common Use Cases

Below are examples of common use cases:

```php
// adding multiple attributes
$html->class('external')->content('MyContent');

// using data attributes
$html->dataAttributes(['analytics' => 'trackClick']);
```

Explore additional methods for setting global attributes such as `accesskey`, `autofocus`, `hidden`, `dir`,
`draggable`, `lang`, `role`, `spellcheck`, `style`, `tabIndex`, `title`, `translate`, and microdata attributes.

## Attributes

Refer to the [Html tests](https://github.com/ui-awesome/html/blob/main/tests/Root/HtmlTest.php) for comprehensive
examples.

The following methods are available for setting attributes:

| Method            | Description                                                                                      |
| ----------------- | ------------------------------------------------------------------------------------------------ |
| `accesskey()`     | Set the `accesskey` global attribute.                                                            |
| `addAriaAttribute()`| Set a single `aria-*` attribute.                                                               |
| `addDataAttribute()`| Set a single `data-*` attribute.                                                               |
| `ariaAttributes()`| Set multiple `aria-*` attributes at once.                                                        |
| `attributes()`    | Set multiple attributes at once.                                                                 |
| `autofocus()`     | Set the `autofocus` global attribute.                                                            |
| `class()`         | Set the `class` global attribute.                                                                |
| `content()`       | Append encoded content to the `<html>` element.                                                  |
| `contentEditable()`| Set the `contenteditable` global attribute.                                                     |
| `dataAttributes()`| Set multiple `data-*` attributes at once.                                                        |
| `dir()`           | Set the `dir` global attribute.                                                                  |
| `draggable()`     | Set the `draggable` global attribute.                                                            |
| `hidden()`        | Set the `hidden` global attribute.                                                               |
| `id()`            | Set the `id` global attribute.                                                                   |
| `itemId()`        | Set the `itemid` global attribute.                                                               |
| `itemProp()`      | Set the `itemprop` global attribute.                                                             |
| `itemRef()`       | Set the `itemref` global attribute.                                                              |
| `itemScope()`     | Set the `itemscope` global attribute.                                                            |
| `itemType()`      | Set the `itemtype` global attribute.                                                             |
| `lang()`          | Set the `lang` global attribute.                                                                 |
| `role()`          | Set the `role` global attribute.                                                                 |
| `spellcheck()`    | Set the `spellcheck` global attribute.                                                           |
| `style()`         | Set the `style` global attribute.                                                                |
| `tabIndex()`      | Set the `tabindex` global attribute.                                                             |
| `title()`         | Set the `title` global attribute.                                                                |
| `translate()`     | Set the `translate` global attribute.                                                            |

## Custom methods

Refer to the [Html tests](https://github.com/ui-awesome/html/blob/main/tests/Root/HtmlTest.php) for comprehensive
examples.

The following methods are available for customizing the `HTML` output:

| Method    | Description                                                                                              |
| --------- | -------------------------------------------------------------------------------------------------------- |
| `begin() `| Start the `html` element.                                                                                |
| `end()`   | End the `html` element, and generate the `HTML` output.                                                  |
| `render()`| Generates the `HTML` output.                                                                             |
| `tag()`   | Instantiates the `Html::class`.                                                                          |
