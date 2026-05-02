<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Autocomplete,
    Data,
    Direction,
    GlobalAttribute,
    Language,
    Role,
    Translate,
    Type,
};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputWeek;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputWeek} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input week specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputWeek} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputWeekTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputWeek::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::WEEK,
                'class' => 'value',
            ],
            InputWeek::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" accesskey="value">
            HTML,
            InputWeek::tag()
                ->accesskey('value')
                ->id('inputweek')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-label="value">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputweek')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-label="value">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputweek')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputweek')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputweek')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputWeek::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputweek')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-controls="value" aria-label="value">
            HTML,
            InputWeek::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputweek')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->attributes(['class' => 'value'])
                ->id('inputweek')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()
                ->autocomplete('on')
                ->id('inputweek')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputweek')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autofocus>
            HTML,
            InputWeek::tag()
                ->autofocus(true)
                ->id('inputweek')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->class('value')
                ->id('inputweek')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->class(BackedString::VALUE)
                ->id('inputweek')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputweek')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag(['class' => 'default-class'])
                ->id('inputweek')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week" title="default-title">
            HTML,
            InputWeek::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputweek')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()
                ->dir('ltr')
                ->id('inputweek')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()
                ->dir(Direction::LTR)
                ->id('inputweek')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" disabled>
            HTML,
            InputWeek::tag()
                ->disabled(true)
                ->id('inputweek')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputWeek::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputweek')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" form="value">
            HTML,
            InputWeek::tag()
                ->form('value')
                ->id('inputweek')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputWeek::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputWeek::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" hidden>
            HTML,
            InputWeek::tag()
                ->hidden(true)
                ->id('inputweek')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" list="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" max="2018-W26">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->max('2018-W26')
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W18">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->min('2018-W18')
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W18" max="2018-W26">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->min('2018-W18')
                ->max('2018-W26')
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" name="value" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" readonly>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputweek')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addAttribute('class', 'value')
                ->id('inputweek')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputweek')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputweek')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" required>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="2">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="any">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" style='value'>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" tabindex="1">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
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
            <input id="inputweek" type="week">
            </div>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputweek')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="week">
            HTML,
            (string) InputWeek::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputWeek::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="week">
            HTML,
            InputWeek::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputWeek::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" value="2018-W18">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->value('2018-W18')
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

        InputWeek::tag()->dir('invalid-value');
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

        InputWeek::tag()->lang('invalid-value');
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

        InputWeek::tag()->role('invalid-value');
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

        InputWeek::tag()->tabIndex(-2);
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

        InputWeek::tag()->translate('invalid-value');
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

        InputWeek::tag()->type('invalid-value');
    }
}
