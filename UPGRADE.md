# Upgrade Guide

## 0.4.0

### PHP and package requirements

- The minimum PHP version is now `^8.3`.
- Runtime dependencies were updated to the current UI Awesome package line:
  - `ui-awesome/html-attribute:^0.6`
  - `ui-awesome/html-core:^0.6`
  - `ui-awesome/html-helper:^0.7`
  - `ui-awesome/html-interop:^0.4`
  - `ui-awesome/html-mixin:^0.6`

### Removed element-owned attribute traits

Element-specific attribute traits were removed from `ui-awesome/html`. Attribute methods now live directly on the
concrete element classes that support them.

Removed trait namespaces:

- `UIAwesome\Html\Embedded\Attribute\*`
- `UIAwesome\Html\Form\Attribute\*`
- `UIAwesome\Html\Interactive\Attribute\*`
- `UIAwesome\Html\List\Attribute\*`
- `UIAwesome\Html\Metadata\Attribute\*`
- `UIAwesome\Html\Table\Attribute\*`

If your application imported those traits for custom elements, remove the imports and move only the required attribute
methods into your custom class.

Before:

```php
use UIAwesome\Html\Form\Attribute\HasAction;

final class CustomForm
{
    use HasAction;
}
```

After:

```php
use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UnitEnum;

final class CustomForm
{
    public function action(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::ACTION, $value);
    }
}
```

When using package elements, call the concrete element APIs directly:

```php
use UIAwesome\Html\Form\Form;

$html = Form::tag()
    ->action('/submit')
    ->method('post')
    ->render();
```

### Attribute mutation APIs

`setAttribute()` is no longer part of the public element API inherited from `ui-awesome/html-mixin`. Use
`addAttribute()` for single attribute updates.

Before:

```php
$element = $element->setAttribute('class', 'button');
```

After:

```php
$element = $element->addAttribute('class', 'button');
```

Use `attributes()` for additive bulk updates and `replaceAttributes()` when the complete attribute bag must be replaced.

### Documentation

- `docs/development.md` was removed. Use `docs/testing.md` for local testing and quality workflow commands.
