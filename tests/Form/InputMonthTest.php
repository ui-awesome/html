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
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputMonth} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input month specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
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
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
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
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" accesskey="value">
            HTML,
            InputMonth::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" aria-label="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" aria-label="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" aria-describedby="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', 'value')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            <span>Suffix</span>
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputmonth')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            <span>Suffix</span>
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputmonth')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputMonth::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" aria-controls="value" aria-label="value">
            HTML,
            InputMonth::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaDescribedByCustomSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', true)
                ->ariaDescribedBySuffix('value')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that 'ariaDescribedBySuffix()' correctly applies the custom suffix.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="month">
            HTML,
            InputMonth::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="inputmonth-help">
            HTML,
            InputMonth::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" autocomplete="on">
            HTML,
            InputMonth::tag()
                ->autocomplete('on')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" autocomplete="on">
            HTML,
            InputMonth::tag()
                ->autocomplete(Autocomplete::ON)
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" autofocus>
            HTML,
            InputMonth::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="month">
            HTML,
            InputMonth::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="month">
            HTML,
            InputMonth::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="month">
            HTML,
            InputMonth::tag(['class' => 'default-class'])
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="month" title="default-title">
            HTML,
            InputMonth::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" dir="ltr">
            HTML,
            InputMonth::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" dir="ltr">
            HTML,
            InputMonth::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" disabled>
            HTML,
            InputMonth::tag()
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputMonth::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" form="value">
            HTML,
            InputMonth::tag()
                ->form('value')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
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
            <input class="default-class" type="month">
            HTML,
            InputMonth::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
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
            <input type="month" hidden>
            HTML,
            InputMonth::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="value" type="month">
            HTML,
            InputMonth::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" lang="en">
            HTML,
            InputMonth::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" lang="en">
            HTML,
            InputMonth::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" list="value">
            HTML,
            InputMonth::tag()
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" max="2022-09">
            HTML,
            InputMonth::tag()
                ->max('2022-09')
                ->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" min="2022-06">
            HTML,
            InputMonth::tag()
                ->min('2022-06')
                ->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" min="2022-06" max="2022-09">
            HTML,
            InputMonth::tag()
                ->min('2022-06')
                ->max('2022-09')
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value" type="month">
            HTML,
            InputMonth::tag()
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" readonly>
            HTML,
            InputMonth::tag()
                ->readonly(true)
                ->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            InputMonth::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" required>
            HTML,
            InputMonth::tag()
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" role="textbox">
            HTML,
            InputMonth::tag()
                ->role('textbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" role="textbox">
            HTML,
            InputMonth::tag()
                ->role(Role::TEXTBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="month">
            HTML,
            InputMonth::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" title="value">
            HTML,
            InputMonth::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" step="2">
            HTML,
            InputMonth::tag()
                ->step(2)
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" step="any">
            HTML,
            InputMonth::tag()
                ->step('any')
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" style='value'>
            HTML,
            InputMonth::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" tabindex="1">
            HTML,
            InputMonth::tag()
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <input type="month">
            </div>
            HTML,
            InputMonth::tag()
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" type="month">
            HTML,
            InputMonth::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" title="value">
            HTML,
            InputMonth::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            (string) InputMonth::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" translate="no">
            HTML,
            InputMonth::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month" translate="no">
            HTML,
            InputMonth::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            'Failed asserting that user-defined attributes override global defaults correctly.',
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
            <input type="month" value="2022-06">
            HTML,
            InputMonth::tag()
                ->value('2022-06')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeArray(Direction::cases())),
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
                implode("', '", Enum::normalizeArray(Language::cases())),
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
                implode("', '", Enum::normalizeArray(Role::cases())),
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
                implode("', '", Enum::normalizeArray(Translate::cases())),
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
                implode("', '", Enum::normalizeArray(Type::cases())),
            ),
        );

        InputMonth::tag()->type('invalid-value');
    }
}
