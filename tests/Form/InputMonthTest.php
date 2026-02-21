<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

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
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputMonth;
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
                'id' => null,
                'type' => Type::MONTH,
                'class' => 'value',
            ],
            InputMonth::tag()
                ->id(null)
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
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
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="value">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputmonth')
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
            <input id="inputmonth" type="month" data-value="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addEvent()' method.",
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
            <input id="inputmonth" type="month" autocomplete="on">
            HTML,
            InputMonth::tag()
                ->autocomplete('on')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
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
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
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
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
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
            'Failed asserting that default configuration values are applied correctly.',
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
            'Failed asserting that default provider is applied correctly.',
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
            'Failed asserting that element renders correctly with default values.',
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'disabled' attribute.",
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
            "Failed asserting that element renders correctly with 'events()' method.",
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
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputMonth::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputmonth-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
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
            <input id="inputmonth" type="month" hidden>
            HTML,
            InputMonth::tag()
                ->hidden(true)
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
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
            "Failed asserting that element renders correctly with 'id' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'list' attribute.",
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
            "Failed asserting that element renders correctly with 'max' attribute.",
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
            "Failed asserting that element renders correctly with 'min' attribute.",
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
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
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
            "Failed asserting that element renders correctly with 'name' attribute.",
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
            "Failed asserting that element renders correctly with 'readonly' attribute.",
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
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->setAttribute('class', 'value')
                ->id('inputmonth')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
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
            "Failed asserting that element renders correctly with 'required' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'step' attribute.",
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
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
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
            "Failed asserting that element renders correctly with 'style' attribute.",
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
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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
            'Failed asserting that element renders correctly with enclosed label and custom template.',
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
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
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
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="month">
            HTML,
            (string) InputMonth::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            <input id="inputmonth" type="month" value="2022-06">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->value('2022-06')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
