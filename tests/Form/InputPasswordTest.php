<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\{BackedInteger, BackedString};
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Autocomplete,
    Data,
    Direction,
    GlobalAttribute,
    InputMode,
    Language,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputPassword;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputPassword} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input password specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `inputmode`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `tabindex`, `value`)
 *   and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputPasswordTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputPassword::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::PASSWORD,
                'class' => 'value',
            ],
            InputPassword::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" accesskey="value">
            HTML,
            InputPassword::tag()
                ->accesskey('value')
                ->id('inputpassword')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-label="value">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputpassword')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-label="value">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputpassword')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-value="value">
            HTML,
            InputPassword::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputpassword')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-value="value">
            HTML,
            InputPassword::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputpassword')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputPassword::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputpassword')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-controls="value" aria-label="value">
            HTML,
            InputPassword::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputpassword')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->attributes(['class' => 'value'])
                ->id('inputpassword')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autocomplete="off">
            HTML,
            InputPassword::tag()
                ->autocomplete('off')
                ->id('inputpassword')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autocomplete="off">
            HTML,
            InputPassword::tag()
                ->autocomplete(Autocomplete::OFF)
                ->id('inputpassword')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autofocus>
            HTML,
            InputPassword::tag()
                ->autofocus(true)
                ->id('inputpassword')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->class('value')
                ->id('inputpassword')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->class(BackedString::VALUE)
                ->id('inputpassword')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-value="value">
            HTML,
            InputPassword::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputpassword')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password">
            HTML,
            InputPassword::tag(['class' => 'default-class'])
                ->id('inputpassword')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password" title="default-title">
            HTML,
            InputPassword::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputpassword')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" dir="ltr">
            HTML,
            InputPassword::tag()
                ->dir('ltr')
                ->id('inputpassword')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" dir="ltr">
            HTML,
            InputPassword::tag()
                ->dir(Direction::LTR)
                ->id('inputpassword')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" disabled>
            HTML,
            InputPassword::tag()
                ->disabled(true)
                ->id('inputpassword')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputPassword::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputpassword')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" form="value">
            HTML,
            InputPassword::tag()
                ->form('value')
                ->id('inputpassword')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputPassword::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputPassword::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" hidden>
            HTML,
            InputPassword::tag()
                ->hidden(true)
                ->id('inputpassword')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithInputMode(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" inputmode="numeric">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->inputMode('numeric')
                ->render(),
            "'inputmode' must be serialized.",
        );
    }

    public function testRenderWithInputModeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" inputmode="numeric">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->inputMode(InputMode::NUMERIC)
                ->render(),
            "'inputmode' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" lang="en">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" lang="en">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" maxlength="12">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->maxlength(12)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" minlength="8">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->minlength(8)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" name="value" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" pattern=".{8,}">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->pattern('.{8,}')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" placeholder="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" readonly>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputpassword')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" required>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" role="textbox">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" role="textbox">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-value="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAttribute('data-value', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" title="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" size="20">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->size(20)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSizeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" size="1">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->size(BackedInteger::VALUE)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" style='value'>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" tabindex="1">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input id="inputpassword" type="password">
            </div>
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" title="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="password">
            HTML,
            (string) InputPassword::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" translate="no">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" translate="no">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputPassword::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="password">
            HTML,
            InputPassword::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputPassword::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" value="value">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
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

        InputPassword::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingInputMode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::INPUTMODE->value,
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, InputMode::cases())),
            ),
        );

        InputPassword::tag()->inputMode('invalid-value');
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

        InputPassword::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMaxlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MAXLENGTH->value,
                'value >= 0',
            ),
        );

        InputPassword::tag()->maxlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMinlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MINLENGTH->value,
                'value >= 0',
            ),
        );

        InputPassword::tag()->minlength(-1);
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

        InputPassword::tag()->role('invalid-value');
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

        InputPassword::tag()->tabIndex(-2);
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

        InputPassword::tag()->translate('invalid-value');
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

        InputPassword::tag()->type('invalid-value');
    }
}
