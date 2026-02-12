<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputMonth;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputMonth} month input behavior.
 *
 * Test coverage.
 * - Applies input-month-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputMonth} for the base implementation.
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
            'default',
            InputMonth::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" accesskey="k">
            HTML,
            InputMonth::tag()
                ->accesskey('k')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-label="Month selector">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('label', 'Month selector')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-hidden="true">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-describedby="custom-help">
            HTML,
            InputMonth::tag()
                ->addAriaAttribute('describedby', 'custom-help')
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

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-test="value">
            HTML,
            InputMonth::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" title="Select month">
            HTML,
            InputMonth::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Select month')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-month="value">
            HTML,
            InputMonth::tag()
                ->addDataAttribute('month', 'value')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-value="test">
            HTML,
            InputMonth::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" aria-controls="month-picker" aria-label="Select a month">
            HTML,
            InputMonth::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'month-picker',
                        'label' => 'Select a month',
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
            <input class="month-input" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->attributes(['class' => 'month-input'])
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
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
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
            <input class="month-input" id="inputmonth" type="month">
            HTML,
            InputMonth::tag()
                ->class('month-input')
                ->id('inputmonth')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" data-month="value">
            HTML,
            InputMonth::tag()
                ->dataAttributes(['month' => 'value'])
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
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
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

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" form="form-id">
            HTML,
            InputMonth::tag()
                ->form('form-id')
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
            <input id="month-input" type="month">
            HTML,
            InputMonth::tag()
                ->id('month-input')
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
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" type="month" list="months">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->list('months')
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
            <input id="inputmonth" type="month" min="2022-01" max="2022-12">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->min('2022-01')
                ->max('2022-12')
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputmonth" name="bday-month" type="month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->name('bday-month')
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
                ->addAriaAttribute('label', 'Close')
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
                ->addAttribute('data-test', 'value')
                ->id('inputmonth')
                ->removeAttribute('data-test')
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
                ->addDataAttribute('value', 'test')
                ->id('inputmonth')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
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
            <input id="inputmonth" type="month" style='width: 200px;'>
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->style('width: 200px;')
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
            <input id="inputmonth" type="month" title="Select a month">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->title('Select a month')
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
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
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
            <input class="from-global" id="id-user" type="month">
            HTML,
            InputMonth::tag(['id' => 'id-user'])->render(),
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
            <input id="inputmonth" type="month" value="2017-06">
            HTML,
            InputMonth::tag()
                ->id('inputmonth')
                ->value('2017-06')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
