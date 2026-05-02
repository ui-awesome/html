<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
    Autocomplete,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputColor;
use UIAwesome\Html\Form\Values\Colorspace;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputColor} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input color specific attributes (`alpha`, `autocomplete`, `autofocus`, `colorspace`, `disabled`, `form`,
 *   `list`, `name`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputColor} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputColorTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputColor::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::COLOR,
                'class' => 'value',
            ],
            InputColor::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" accesskey="value">
            HTML,
            InputColor::tag()
                ->accesskey('value')
                ->id('inputcolor')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" aria-label="value">
            HTML,
            InputColor::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcolor')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" aria-label="value">
            HTML,
            InputColor::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputcolor')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" data-value="value">
            HTML,
            InputColor::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcolor')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" data-value="value">
            HTML,
            InputColor::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputcolor')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputColor::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcolor')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAlpha(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" alpha>
            HTML,
            InputColor::tag()
                ->alpha(true)
                ->id('inputcolor')
                ->render(),
            "'alpha' must be serialized.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" aria-controls="value" aria-label="value">
            HTML,
            InputColor::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputcolor')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->attributes(['class' => 'value'])
                ->id('inputcolor')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" autocomplete="on">
            HTML,
            InputColor::tag()
                ->autocomplete('on')
                ->id('inputcolor')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" autocomplete="on">
            HTML,
            InputColor::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputcolor')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" autofocus>
            HTML,
            InputColor::tag()
                ->autofocus(true)
                ->id('inputcolor')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->class('value')
                ->id('inputcolor')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->class(BackedString::VALUE)
                ->id('inputcolor')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithColorspace(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" colorspace="display-p3">
            HTML,
            InputColor::tag()
                ->colorspace('display-p3')
                ->id('inputcolor')
                ->render(),
            "'colorspace' must be serialized.",
        );
    }

    public function testRenderWithColorspaceUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" colorspace="display-p3">
            HTML,
            InputColor::tag()
                ->colorspace(Colorspace::DISPLAY_P3)
                ->id('inputcolor')
                ->render(),
            "'colorspace' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" data-value="value">
            HTML,
            InputColor::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputcolor')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcolor" type="color">
            HTML,
            InputColor::tag(['class' => 'default-class'])
                ->id('inputcolor')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcolor" type="color" title="default-title">
            HTML,
            InputColor::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputcolor')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" dir="ltr">
            HTML,
            InputColor::tag()
                ->dir('ltr')
                ->id('inputcolor')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" dir="ltr">
            HTML,
            InputColor::tag()
                ->dir(Direction::LTR)
                ->id('inputcolor')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" disabled>
            HTML,
            InputColor::tag()
                ->disabled(true)
                ->id('inputcolor')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputColor::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputcolor')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" form="value">
            HTML,
            InputColor::tag()
                ->form('value')
                ->id('inputcolor')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputColor::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputColor::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" hidden>
            HTML,
            InputColor::tag()
                ->hidden(true)
                ->id('inputcolor')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" lang="en">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" lang="en">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" list="value">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" name="value" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcolor')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->addAttribute('class', 'value')
                ->id('inputcolor')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcolor')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcolor')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" role="textbox">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" role="textbox">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" title="value">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" style='value'>
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" tabindex="1">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
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
            <input id="inputcolor" type="color">
            </div>
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputcolor" type="color">
            HTML,
            InputColor::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputcolor')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" title="value">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="color">
            HTML,
            (string) InputColor::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" translate="no">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" translate="no">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputColor::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="color">
            HTML,
            InputColor::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputColor::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcolor" type="color" value="#ff0000">
            HTML,
            InputColor::tag()
                ->id('inputcolor')
                ->value('#ff0000')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputColor = InputColor::tag();

        self::assertNotSame(
            $inputColor,
            $inputColor->alpha(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $inputColor,
            $inputColor->colorspace(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingColorspace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'colorspace',
                implode("', '", array_map(static fn(\BackedEnum $case): string => $case->value, Colorspace::cases())),
            ),
        );

        InputColor::tag()->colorspace('invalid-value');
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

        InputColor::tag()->dir('invalid-value');
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

        InputColor::tag()->lang('invalid-value');
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

        InputColor::tag()->role('invalid-value');
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

        InputColor::tag()->tabIndex(-2);
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

        InputColor::tag()->translate('invalid-value');
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

        InputColor::tag()->type('invalid-value');
    }
}
