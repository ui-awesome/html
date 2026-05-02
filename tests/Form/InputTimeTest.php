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
use UIAwesome\Html\Form\InputTime;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputTime} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input time specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputTime} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputTimeTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputTime::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::TIME,
                'class' => 'value',
            ],
            InputTime::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" accesskey="value">
            HTML,
            InputTime::tag()
                ->accesskey('value')
                ->id('inputtime')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-label="value">
            HTML,
            InputTime::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputtime')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-label="value">
            HTML,
            InputTime::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputtime')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-value="value">
            HTML,
            InputTime::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputtime')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-value="value">
            HTML,
            InputTime::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputtime')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputTime::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputtime')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-controls="value" aria-label="value">
            HTML,
            InputTime::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputtime')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->attributes(['class' => 'value'])
                ->id('inputtime')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autocomplete="on">
            HTML,
            InputTime::tag()
                ->autocomplete('on')
                ->id('inputtime')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autocomplete="on">
            HTML,
            InputTime::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputtime')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autofocus>
            HTML,
            InputTime::tag()
                ->autofocus(true)
                ->id('inputtime')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->class('value')
                ->id('inputtime')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->class(BackedString::VALUE)
                ->id('inputtime')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-value="value">
            HTML,
            InputTime::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputtime')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time">
            HTML,
            InputTime::tag(['class' => 'default-class'])
                ->id('inputtime')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time" title="default-title">
            HTML,
            InputTime::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputtime')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" dir="ltr">
            HTML,
            InputTime::tag()
                ->dir('ltr')
                ->id('inputtime')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" dir="ltr">
            HTML,
            InputTime::tag()
                ->dir(Direction::LTR)
                ->id('inputtime')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" disabled>
            HTML,
            InputTime::tag()
                ->disabled(true)
                ->id('inputtime')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputTime::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputtime')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" form="value">
            HTML,
            InputTime::tag()
                ->form('value')
                ->id('inputtime')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputTime::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputTime::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" hidden>
            HTML,
            InputTime::tag()
                ->hidden(true)
                ->id('inputtime')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" lang="en">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" lang="en">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" list="value">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" max="18:00">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->max('18:00')
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" min="09:00">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->min('09:00')
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" min="09:00" max="18:00">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->min('09:00')
                ->max('18:00')
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" name="value" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" readonly>
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputtime')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->addAttribute('class', 'value')
                ->id('inputtime')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputtime')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputtime')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" required>
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" role="textbox">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" role="textbox">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" title="value">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" step="2">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" step="any">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" style='value'>
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" tabindex="1">
            HTML,
            InputTime::tag()
                ->id('inputtime')
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
            <input id="inputtime" type="time">
            </div>
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputtime')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" title="value">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="time">
            HTML,
            (string) InputTime::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" translate="no">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" translate="no">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputTime::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="time">
            HTML,
            InputTime::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(InputTime::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" value="09:00">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->value('09:00')
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

        InputTime::tag()->dir('invalid-value');
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

        InputTime::tag()->lang('invalid-value');
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

        InputTime::tag()->role('invalid-value');
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

        InputTime::tag()->tabIndex(-2);
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

        InputTime::tag()->translate('invalid-value');
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

        InputTime::tag()->type('invalid-value');
    }
}
