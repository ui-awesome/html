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
use UIAwesome\Html\Form\InputMonth;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputMonth} class.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputMonthTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputMonth::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::MONTH,
                'class' => 'value',
            ],
            InputMonth::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" accesskey="value">
            HTML,
            InputMonth::tag()
                ->accesskey('value')
                ->id('inputmonth')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-label="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputmonth')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-label="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputmonth')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputmonth')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputmonth')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputMonth::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputmonth')
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-controls="value" aria-label="value">
            HTML,
            InputMonth::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputmonth')
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->attributes(['class' => 'value'])
                ->id('inputmonth')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" autocomplete="on">
            HTML,
            InputMonth::tag()
                ->autocomplete('on')
                ->id('inputmonth')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" autocomplete="on">
            HTML,
            InputMonth::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputmonth')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" autofocus>
            HTML,
            InputMonth::tag()
                ->autofocus(true)
                ->id('inputmonth')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->class('value')
                ->id('inputmonth')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->class(BackedString::VALUE)
                ->id('inputmonth')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputmonth')
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputmonth" type="month">
            HTML,
            InputMonth::tag(['class' => 'default-class'])
                ->id('inputmonth')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputmonth" type="month" title="default-title">
            HTML,
            InputMonth::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputmonth')
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" dir="ltr">
            HTML,
            InputMonth::tag()
                ->dir('ltr')
                ->id('inputmonth')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" dir="ltr">
            HTML,
            InputMonth::tag()
                ->dir(Direction::LTR)
                ->id('inputmonth')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" disabled>
            HTML,
            InputMonth::tag()
                ->disabled(true)
                ->id('inputmonth')
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputMonth::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputmonth')
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" form="value">
            HTML,
            InputMonth::tag()
                ->form('value')
                ->id('inputmonth')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputMonth::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            InputMonth::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" hidden>
            HTML,
            InputMonth::tag()
                ->hidden(true)
                ->id('inputmonth')
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" lang="en">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" lang="en">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" list="value">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" max="2022-09">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->max('2022-09')
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" min="2022-06">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->min('2022-06')
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" min="2022-06" max="2022-09">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->min('2022-06')
                ->max('2022-09')
                ->render(),
            'min and max must be serialized together.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" name="value" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" readonly>
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputmonth')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->addAttribute('class', 'value')
                ->id('inputmonth')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputmonth')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputmonth')
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" required>
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" role="textbox">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->role('textbox')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" role="textbox">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->role(Role::TEXTBOX)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" title="value">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" step="2">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->step(2)
                ->render(),
            "'step' must be serialized.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" step="any">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->step('any')
                ->render(),
            'step must accept the literal `any`.',
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" style='value'>
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" tabindex="1">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
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
            <input id="inputmonth" type="month">
            </div>
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Custom template wrapper must be applied.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputmonth')
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" title="value">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            (string) InputMonth::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" translate="no">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" translate="no">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputMonth::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="month">
            HTML,
            InputMonth::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            InputMonth::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" value="2022-06">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->value('2022-06')
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
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
            ),
        );

        InputMonth::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeStringArray(Language::cases())),
            ),
        );

        InputMonth::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeStringArray(Role::cases())),
            ),
        );

        InputMonth::tag()->role('invalid-value');
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

        InputMonth::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        InputMonth::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeStringArray(Type::cases())),
            ),
        );

        InputMonth::tag()->type('invalid-value');
    }
}
