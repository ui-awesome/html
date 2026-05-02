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
use UIAwesome\Html\Form\InputDate;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputDate} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input date specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputDate} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputDateTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputDate::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::DATE,
                'class' => 'value',
            ],
            InputDate::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" accesskey="value">
            HTML,
            InputDate::tag()
                ->accesskey('value')
                ->id('inputdate')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" aria-label="value">
            HTML,
            InputDate::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputdate')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" aria-label="value">
            HTML,
            InputDate::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputdate')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" data-value="value">
            HTML,
            InputDate::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputdate')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" data-value="value">
            HTML,
            InputDate::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputdate')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputDate::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputdate')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" aria-controls="value" aria-label="value">
            HTML,
            InputDate::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputdate')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->attributes(['class' => 'value'])
                ->id('inputdate')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" autocomplete="on">
            HTML,
            InputDate::tag()
                ->autocomplete('on')
                ->id('inputdate')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" autocomplete="on">
            HTML,
            InputDate::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputdate')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" autofocus>
            HTML,
            InputDate::tag()
                ->autofocus(true)
                ->id('inputdate')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->class('value')
                ->id('inputdate')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->class(BackedString::VALUE)
                ->id('inputdate')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" data-value="value">
            HTML,
            InputDate::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputdate')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdate" type="date">
            HTML,
            InputDate::tag(['class' => 'default-class'])
                ->id('inputdate')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdate" type="date" title="default-title">
            HTML,
            InputDate::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputdate')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" dir="ltr">
            HTML,
            InputDate::tag()
                ->dir('ltr')
                ->id('inputdate')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" dir="ltr">
            HTML,
            InputDate::tag()
                ->dir(Direction::LTR)
                ->id('inputdate')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" disabled>
            HTML,
            InputDate::tag()
                ->disabled(true)
                ->id('inputdate')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputDate::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputdate')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" form="value">
            HTML,
            InputDate::tag()
                ->form('value')
                ->id('inputdate')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputDate::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputDate::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" hidden>
            HTML,
            InputDate::tag()
                ->hidden(true)
                ->id('inputdate')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" lang="en">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" lang="en">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" list="value">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" max="2017-04-30">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->max('2017-04-30')
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" min="2017-04-01">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->min('2017-04-01')
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" min="2017-04-01" max="2017-04-30">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->min('2017-04-01')
                ->max('2017-04-30')
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" name="value" type="date">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" readonly>
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputdate')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->addAttribute('class', 'value')
                ->id('inputdate')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputdate')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputdate')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" required>
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" role="textbox">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" role="textbox">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" title="value">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" step="2">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" step="any">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" style='value'>
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" tabindex="1">
            HTML,
            InputDate::tag()
                ->id('inputdate')
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
            <input id="inputdate" type="date">
            </div>
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputdate" type="date">
            HTML,
            InputDate::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputdate')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" title="value">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="date">
            HTML,
            (string) InputDate::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" translate="no">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" translate="no">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputDate::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="date">
            HTML,
            InputDate::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputDate::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date" value="2017-06-01">
            HTML,
            InputDate::tag()
                ->id('inputdate')
                ->value('2017-06-01')
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

        InputDate::tag()->dir('invalid-value');
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

        InputDate::tag()->lang('invalid-value');
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

        InputDate::tag()->role('invalid-value');
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

        InputDate::tag()->tabIndex(-2);
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

        InputDate::tag()->translate('invalid-value');
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

        InputDate::tag()->type('invalid-value');
    }
}
