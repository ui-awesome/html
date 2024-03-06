# Html

The repository also provides a helper class called `Builder::class` that you can use to generate `HTML` code.

The `Builder::class` class provides a wide range of methods for creating `HTML` elements, making it easy to generate
`HTML` code programmatically using `PHP`.

## Creating a new HTML element

To create a new `HTML` element, you can use the `Builder::class` with the `createTag()` method.

Allowed arguments are:

- `tag` (string) - The tag name.
- `content` (string) - The content of the tag.
- `attributes` (array) - The attributes of the tag.

```php
<?php

declare(strict_types=1);

use UIAwesome\Html\Builder;
?>

<?= Builder::createTag('div', 'Hello, World!', ['class' => 'container']) ?>
```

Or you can use the `Builder::class` with the `begin()` and `end()` methods.

Allowed arguments for `begin()` method are:

- `tag` (string) - The tag name.
- `attributes` (array) - The attributes of the tag.

Allowed arguments for `end()` method are:

- `tag` (string) - The tag name.

```php
<?php

declare(strict_types=1);

use UIAwesome\Html\Builder;
?>

<?= Builder::beginTag('div', ['class' => 'container']) ?>
    Hello, World!
<?= Builder::endTag('div') ?>
```
