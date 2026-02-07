<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputRange;
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
#[Group('html')]
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
            <input id="inputrange-" type="range" accesskey="k">
            HTML,
            InputRange::tag()->id('inputrange-')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" aria-label="Range selector">
            HTML,
            InputRange::tag()->id('inputrange-')->addAriaAttribute('label', 'Range selector')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" aria-hidden="true">
            HTML,
            InputRange::tag()->id('inputrange-')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" data-test="value">
            HTML,
            InputRange::tag()->id('inputrange-')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" title="Select range">
            HTML,
            InputRange::tag()->id('inputrange-')->addAttribute(GlobalAttribute::TITLE, 'Select range')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" data-range="value">
            HTML,
            InputRange::tag()->id('inputrange-')->addDataAttribute('range', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" data-value="test">
            HTML,
            InputRange::tag()->id('inputrange-')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" aria-controls="range-picker" aria-label="Select a range">
            HTML,
            InputRange::tag()
                ->id('inputrange-')
                ->ariaAttributes([
                    'controls' => 'range-picker',
                    'label' => 'Select a range',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="range-input" id="inputrange-" type="range">
            HTML,
            InputRange::tag()->id('inputrange-')->attributes(['class' => 'range-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" autocomplete="on">
            HTML,
            InputRange::tag()->autocomplete('on')->id('inputrange-')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" autocomplete="on">
            HTML,
            InputRange::tag()->autocomplete(Autocomplete::ON)->id('inputrange-')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" autofocus>
            HTML,
            InputRange::tag()->autofocus(true)->id('inputrange-')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="range-input" id="inputrange-" type="range">
            HTML,
            InputRange::tag()->id('inputrange-')->class('range-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" data-range="value">
            HTML,
            InputRange::tag()->id('inputrange-')->dataAttributes(['range' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange-" type="range">
            HTML,
            InputRange::tag(['class' => 'default-class'])->id('inputrange-')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputrange-" type="range" title="default-title">
            HTML,
            InputRange::tag()->id('inputrange-')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        $output = InputRange::tag()->render();

        self::assertStringContainsString('type="range"', $output);
        self::assertStringContainsString('<input', $output);
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" dir="ltr">
            HTML,
            InputRange::tag()->id('inputrange-')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" dir="ltr">
            HTML,
            InputRange::tag()->id('inputrange-')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" disabled>
            HTML,
            InputRange::tag()->id('inputrange-')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" form="form-id">
            HTML,
            InputRange::tag()->form('form-id')->id('inputrange-')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputRange::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputRange::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputRange::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" hidden>
            HTML,
            InputRange::tag()->id('inputrange-')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="range-input" type="range">
            HTML,
            InputRange::tag()->id('range-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" lang="en">
            HTML,
            InputRange::tag()->id('inputrange-')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" lang="en">
            HTML,
            InputRange::tag()->id('inputrange-')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" list="ranges">
            HTML,
            InputRange::tag()->id('inputrange-')->list('ranges')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" max="100">
            HTML,
            InputRange::tag()->id('inputrange-')->max(100)->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" min="10">
            HTML,
            InputRange::tag()->id('inputrange-')->min(10)->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" min="10" max="100">
            HTML,
            InputRange::tag()
                ->id('inputrange-')
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
            <input id="inputrange-" name="volume" type="range">
            HTML,
            InputRange::tag()->id('inputrange-')->name('volume')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange-')
                ->addAriaAttribute('label', 'Close')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange-')
                ->addAttribute('data-test', 'value')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range">
            HTML,
            InputRange::tag()
                ->id('inputrange-')
                ->addDataAttribute('value', 'test')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" role="slider">
            HTML,
            InputRange::tag()->id('inputrange-')->role('slider')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" role="slider">
            HTML,
            InputRange::tag()->id('inputrange-')->role(Role::SLIDER)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" step="2">
            HTML,
            InputRange::tag()->id('inputrange-')->step(2)->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" step="any">
            HTML,
            InputRange::tag()->id('inputrange-')->step('any')->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" style='width: 200px;'>
            HTML,
            InputRange::tag()->id('inputrange-')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" tabindex="1">
            HTML,
            InputRange::tag()->id('inputrange-')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputrange-" type="range">
            HTML,
            InputRange::tag()->id('inputrange-')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" title="Select a range">
            HTML,
            InputRange::tag()->id('inputrange-')->title('Select a range')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertStringContainsString(
            'type="range"',
            LineEndingNormalizer::normalize((string) InputRange::tag()),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" translate="no">
            HTML,
            InputRange::tag()->id('inputrange-')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" translate="no">
            HTML,
            InputRange::tag()->id('inputrange-')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputRange::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputRange::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputRange::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputrange-" type="range" value="50">
            HTML,
            InputRange::tag()->id('inputrange-')->value(50)->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
