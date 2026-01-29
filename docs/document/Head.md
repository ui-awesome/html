# Head

The `<head>` `HTML` element contains machine-readable information (metadata) about the document, like its title,
scripts, and style sheets.

## Basic Usage

Instantiate the `Head` class using `Head::tag()`.

```php
$head = Head::tag();
```

Or, block style instantiation.

```php
<?= Head::tag()->begin() ?>
    // ... content to be wrapped by `head` element
<?= Head::end() ?>
```

## Setting Attributes

Use the provided methods to set global attributes for the element.

```php
// setting class attribute
$head->class('container');
```

Or, use the `attributes` method to set multiple attributes at once.

```php
$head->attributes(['class' => 'container', 'style' => 'background-color: #eee;']);
```

## Adding Content

If you want to include content within the `head` tag, use the `content` method.

```php
$head->content('MyContent');
```

Or, use `begin()` and `end()` methods to wrap content.

```php
<?= Head::tag()->begin() ?>
    My content
<?= Head::end() ?>
```

## Rendering

Generate the `HTML` output using the `render` method, for simple instantiation. 

```php
$html = $head->render();
```

For block style instantiation, use the `end()` method, which returns the `HTML` output.

```php
$html = Head::end();
```

Or, use the magic `__toString` method.

```php
$html = (string) $head;
```

## Common Use Cases

Below are examples of common use cases:

```php
// adding multiple attributes
$head->class('external')->content('MyContent');

// using data attributes
$head->dataAttributes(['analytics' => 'trackClick']);
```

Explore additional methods for setting global attributes such as `accesskey`, `autofocus`, `hidden`, `dir`, `draggable`,
`lang`, `role`, `spellcheck`, `style`, `tabIndex`, `title`, `translate`, and microdata attributes.

## Attributes

Refer to the [Head tests](https://github.com/ui-awesome/html/blob/main/tests/Root/HeadTest.php) for comprehensive
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
| `content()`       | Append encoded content to the `<head>` element.                                                  |
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

Refer to the [Head tests](https://github.com/ui-awesome/html/blob/main/tests/Root/HeadTest.php) for comprehensive
examples.

The following methods are available for customizing the `HTML` output:

| Method    | Description                                                                                              |
| --------- | -------------------------------------------------------------------------------------------------------- |
| `begin() `| Start the `head` element.                                                                                |
| `end()`   | End the `head` element, and generate the `HTML` output.                                                  |
| `render()`| Generates the `HTML` output.                                                                             |
| `tag()`   | Instantiates the `Head::class`.                                                                          |
