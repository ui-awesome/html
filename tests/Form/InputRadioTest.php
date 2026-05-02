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
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Form\CheckedProvider;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};
use UnitEnum;

use function str_replace;

/**
 * Unit tests for the {@see InputRadio} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input radio specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
 *   `tabindex`, `value`) and renders expected output.
 * - Handles edge cases for `checked` attribute with various data types and value comparisons.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputRadioTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputRadio::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::RADIO,
                'class' => 'value',
            ],
            InputRadio::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" accesskey="value">
            HTML,
            InputRadio::tag()
                ->accesskey('value')
                ->id('inputradio')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-label="value">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputradio')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-label="value">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputradio')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputradio')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputradio')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputRadio::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputradio')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-controls="value" aria-label="value">
            HTML,
            InputRadio::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputradio')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->attributes(['class' => 'value'])
                ->id('inputradio')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" autofocus>
            HTML,
            InputRadio::tag()
                ->autofocus(true)
                ->id('inputradio')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" checked>
            HTML,
            InputRadio::tag()
                ->checked(true)
                ->id('inputradio')
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
        // CheckedProvider returns checkbox-flavored expected HTML; adapt for radio.
        $expected = str_replace(
            ['inputcheckbox', 'type="checkbox"'],
            ['inputradio', 'type="radio"'],
            $expected,
        );

        self::assertSame(
            $expected,
            InputRadio::tag()
                ->checked($checked)
                ->id('inputradio')
                ->value($value)
                ->render(),
            'checked and value must be serialized together.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->class('value')
                ->id('inputradio')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->class(BackedString::VALUE)
                ->id('inputradio')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputradio')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio">
            HTML,
            InputRadio::tag(['class' => 'default-class'])
                ->id('inputradio')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio" title="default-title">
            HTML,
            InputRadio::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputradio')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" dir="ltr">
            HTML,
            InputRadio::tag()
                ->dir('ltr')
                ->id('inputradio')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" dir="ltr">
            HTML,
            InputRadio::tag()
                ->dir(Direction::LTR)
                ->id('inputradio')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" disabled>
            HTML,
            InputRadio::tag()
                ->disabled(true)
                ->id('inputradio')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputRadio::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputradio')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" form="value">
            HTML,
            InputRadio::tag()
                ->form('value')
                ->id('inputradio')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputRadio::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputRadio::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" hidden>
            HTML,
            InputRadio::tag()
                ->hidden(true)
                ->id('inputradio')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" lang="en">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" lang="en">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" name="value" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputradio')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addAttribute('class', 'value')
                ->id('inputradio')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputradio')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputradio')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" required>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" role="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->role('radio')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" role="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->role(Role::RADIO)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" title="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" style='value'>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" tabindex="1">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputradio')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" title="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="radio">
            HTML,
            (string) InputRadio::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" translate="no">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" translate="no">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputRadio::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="radio">
            HTML,
            InputRadio::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(InputRadio::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" value="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputRadio = InputRadio::tag();

        self::assertNotSame(
            $inputRadio,
            $inputRadio->checked(true),
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

        InputRadio::tag()->dir('invalid-value');
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

        InputRadio::tag()->lang('invalid-value');
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

        InputRadio::tag()->role('invalid-value');
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

        InputRadio::tag()->tabIndex(-2);
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

        InputRadio::tag()->translate('invalid-value');
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

        InputRadio::tag()->type('invalid-value');
    }
}
