# Upgrade Guide

## 0.7.0

### Tag configuration

`html-core` 0.9 rejects numeric keys and keys that match no method or property in `tag()` definitions, class
`loadDefault()` definitions, and `SimpleFactory::configure()`. These keys were previously ignored; they now raise
`UIAwesome\Html\Core\Exception\ConfigException`. Remove them or replace them with valid configuration keys:

```php
use UIAwesome\Html\Flow\Div;

$notice = Div::tag(['class' => 'notice']);
```

### Content method signatures

`ContentInterface::content()` and `html()` now accept `UnitEnum` in addition to `string` and `Stringable`. Update
custom implementations and overrides to accept the expanded parameter types; otherwise PHP can reject the class as
incompatible. Keep the existing method bodies and return types. For example, the declarations can be:

```php
use UIAwesome\Html\Contracts\Element\ContentInterface;

abstract class CustomContent implements ContentInterface
{
    abstract public function content(string|Stringable|UnitEnum ...$values): static;

    abstract public function html(string|Stringable|UnitEnum ...$values): static;
}
```

### Checkbox and radio selection

Explicit `checked()` selections now override a raw `checked` attribute for checkbox and radio inputs and their lists.
In particular, `checked(false)` and `checked(null)` remove the raw attribute. If no selection is configured, the raw
attribute remains available as a default. Review forms that combined both settings and use the intended selection
explicitly:

```php
use UIAwesome\Html\Form\InputCheckbox;

$input = InputCheckbox::tag()->addAttribute('checked', true)->checked(false);
```

## 0.5.0

### Typed form choices

`Select::options()` now accepts `Option` instances instead of value-label arrays.

Before:

```php
$select->options(
    ['dog', 'Dog'],
    ['cat', 'Cat'],
);
```

After:

```php
use UIAwesome\Html\Form\Option;

$select->options(
    Option::tag()->value('dog')->content('Dog'),
    Option::tag()->value('cat')->content('Cat'),
);
```

Use `Select::value()` to select child options. Pass an array when `multiple()` is enabled and at most one value
otherwise.

`ChoiceItem`, `CheckboxList`, and `RadioList` provide the equivalent typed API for checkbox and radio groups.

### Scoped configuration

Global configuration through `SimpleFactory::$defaults`, `SimpleFactory::getDefaults()`, and
`SimpleFactory::setDefaults()` is no longer available. Apply an application-scoped `Config` before local setters that
must take precedence:

```php
$select = Select::tag()
    ->config($config, new ComponentContext('field.control.select'))
    ->id('country');
```

`Select` and `TextArea` implement `FormControlInterface`. `Select` also implements `MultiValueInterface`, and elements
with shared `value`, `src`, checked-state, or placeholder APIs now implement their corresponding contracts.

### Open `type()` values

`Link`, `Script`, `Style`, and `A` no longer validate `type()` against the `<input>` type list. They accept any
`string`, `Stringable`, or `UnitEnum` value because the attribute represents a MIME type or script token on these
elements.

```php
Link::tag()->type('application/rss+xml');
Script::tag()->type('application/ld+json');
A::tag()->type('application/pdf');
```

Code that relied on `InvalidArgumentException` for unsupported values must validate them before calling `type()`.
`Button` and the `Input*` controls keep their closed type domains.

## 0.4.0

### Removed element-owned attribute traits

Element-specific attribute traits under these namespaces were removed:

- `UIAwesome\Html\Embedded\Attribute\*`
- `UIAwesome\Html\Form\Attribute\*`
- `UIAwesome\Html\Interactive\Attribute\*`
- `UIAwesome\Html\List\Attribute\*`
- `UIAwesome\Html\Metadata\Attribute\*`
- `UIAwesome\Html\Table\Attribute\*`

Package elements expose the supported attribute methods directly. Custom elements that imported the removed traits
must define or compose only the attribute methods they need.

### Attribute mutation

`setAttribute()` is no longer available. Use `addAttribute()` for one attribute, `attributes()` for additive bulk
updates, or `replaceAttributes()` to replace the complete attribute bag.

Before:

```php
$element = $element->setAttribute('class', 'button');
```

After:

```php
$element = $element->addAttribute('class', 'button');
```
