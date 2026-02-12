<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputRange;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputRange} range input behavior.
 *
 * Test coverage.
 * - Applies input-range-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `step`, `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputRange} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputRangeTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputRange::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" accesskey="k">
            HTML,
            InputRange::tag()
                ->accesskey('k')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-label="Range selector">
            HTML,
            InputRange::tag()
                ->addAriaAttribute('label', 'Range selector')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-hidden="true">
            HTML,
            InputRange::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-describedby="custom-help">
            HTML,
            InputRange::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputrange')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="range">
            HTML,
            InputRange::tag()
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
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            <span>Suffix</span>
            HTML,
            InputRange::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputrange')
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
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            <span>Suffix</span>
            HTML,
            InputRange::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputrange')
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
            <input id="inputrange" type="range" data-test="value">
            HTML,
            InputRange::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" title="Select range">
            HTML,
            InputRange::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Select range')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" data-range="value">
            HTML,
            InputRange::tag()
                ->addDataAttribute('range', 'value')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" data-value="test">
            HTML,
            InputRange::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-controls="range-picker" aria-label="Select a range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->ariaAttributes(
                    [
                        'controls' => 'range-picker',
                        'label' => 'Select a range',
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
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="range-input" id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->attributes(['class' => 'range-input'])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" aria-describedby="inputrange-help">
            HTML,
            InputRange::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" autocomplete="on">
            HTML,
            InputRange::tag()
                ->autocomplete('on')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" autocomplete="on">
            HTML,
            InputRange::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" autofocus>
            HTML,
            InputRange::tag()
                ->autofocus(true)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="range-input" id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->class('range-input')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" data-range="value">
            HTML,
            InputRange::tag()
                ->dataAttributes(['range' => 'value'])
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange" type="range">
            HTML,
            InputRange::tag(['class' => 'default-class'])
                ->id('inputrange')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange" type="range" title="default-title">
            HTML,
            InputRange::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputrange')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" dir="ltr">
            HTML,
            InputRange::tag()
                ->dir('ltr')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" dir="ltr">
            HTML,
            InputRange::tag()
                ->dir(Direction::LTR)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" disabled>
            HTML,
            InputRange::tag()
                ->disabled(true)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" form="form-id">
            HTML,
            InputRange::tag()
                ->form('form-id')
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputRange::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputrange-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputRange::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputRange::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" hidden>
            HTML,
            InputRange::tag()
                ->hidden(true)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="range-input" type="range">
            HTML,
            InputRange::tag()
                ->id('range-input')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" lang="en">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" lang="en">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" list="ranges">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->list('ranges')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" max="100">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->max(100)
                ->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" min="10">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->min(10)
                ->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" min="10" max="100">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->min(10)
                ->max(100)
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" name="volume" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->name('volume')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->addAriaAttribute('label', 'Close')
                ->id('inputrange')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputrange')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->addDataAttribute('value', 'test')
                ->id('inputrange')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" role="slider">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->role('slider')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" role="slider">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->role(Role::SLIDER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" step="2">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->step(2)
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" step="any">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->step('any')
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" style='width: 200px;'>
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->style('width: 200px;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" tabindex="1">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputrange" type="range">
            HTML,
            InputRange::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputrange')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" title="Select a range">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->title('Select a range')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="range">
            HTML,
            (string) InputRange::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" translate="no">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" translate="no">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputRange::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="range">
            HTML,
            InputRange::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputRange::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange" type="range" value="50">
            HTML,
            InputRange::tag()
                ->id('inputrange')
                ->value(50)
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
