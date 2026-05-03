<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputCheckbox;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Form\CheckedProvider;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};
use UnitEnum;

/**
 * Unit tests for the {@see InputCheckbox} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input checkbox specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
 *   `tabindex`, `value`) and renders expected output.
 * - Handles edge cases for `checked` attribute with various data types and value comparisons.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputCheckboxTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputCheckbox::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::CHECKBOX,
                'class' => 'value',
            ],
            InputCheckbox::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" accesskey="value">
            HTML,
            InputCheckbox::tag()
                ->accesskey('value')
                ->id('inputcheckbox')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-label="value">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcheckbox')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-hidden="true">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputcheckbox')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcheckbox')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputcheckbox')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputCheckbox::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcheckbox')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-controls="value" aria-label="value">
            HTML,
            InputCheckbox::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputcheckbox')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->attributes(['class' => 'value'])
                ->id('inputcheckbox')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" autofocus>
            HTML,
            InputCheckbox::tag()
                ->autofocus(true)
                ->id('inputcheckbox')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" checked>
            HTML,
            InputCheckbox::tag()
                ->checked(true)
                ->id('inputcheckbox')
                ->render(),
            "'checked' must be serialized.",
        );
    }

    /**
     * @phpstan-param mixed[]|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    #[DataProviderExternal(CheckedProvider::class, 'checked')]
    public function testRenderWithCheckedAndValue(
        bool|float|int|string|array|Stringable|UnitEnum|null $checked,
        bool|float|int|string|Stringable|UnitEnum|null $value,
        string $expected,
    ): void {
        self::assertSame(
            $expected,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->checked($checked)
                ->value($value)
                ->render(),
            'checked and value must be serialized together.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class('value')
                ->id('inputcheckbox')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class(BackedString::VALUE)
                ->id('inputcheckbox')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputcheckbox')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag(['class' => 'default-class'])
                ->id('inputcheckbox')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox" title="default-title">
            HTML,
            InputCheckbox::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputcheckbox')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir('ltr')
                ->id('inputcheckbox')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir(Direction::LTR)
                ->id('inputcheckbox')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" disabled>
            HTML,
            InputCheckbox::tag()
                ->disabled(true)
                ->id('inputcheckbox')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputCheckbox::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputcheckbox')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" form="value">
            HTML,
            InputCheckbox::tag()
                ->form('value')
                ->id('inputcheckbox')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputCheckbox::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" hidden>
            HTML,
            InputCheckbox::tag()
                ->hidden(true)
                ->id('inputcheckbox')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" name="value" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcheckbox')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAttribute('class', 'value')
                ->id('inputcheckbox')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcheckbox')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcheckbox')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" required>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->role('checkbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->role(Role::CHECKBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" title="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" style='value'>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" tabindex="1">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputcheckbox')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" title="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="checkbox">
            HTML,
            (string) InputCheckbox::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="checkbox">
            HTML,
            InputCheckbox::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" value="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputCheckbox = InputCheckbox::tag();

        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->checked(true),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Direction::cases())),
            ),
        );

        InputCheckbox::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Language::cases())),
            ),
        );

        InputCheckbox::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Role::cases())),
            ),
        );

        InputCheckbox::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        InputCheckbox::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Translate::cases())),
            ),
        );

        InputCheckbox::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Type::cases())),
            ),
        );

        InputCheckbox::tag()->type('invalid-value');
    }
}
