<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputWeek;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputWeek} week input behavior.
 *
 * Test coverage.
 * - Applies input-week-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
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
            'default',
            InputWeek::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" accesskey="k">
            HTML,
            InputWeek::tag()->id('inputweek')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-label="Week selector">
            HTML,
            InputWeek::tag()->id('inputweek')->addAriaAttribute('label', 'Week selector')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-hidden="true">
            HTML,
            InputWeek::tag()->id('inputweek')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="custom-help">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputweek')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="week">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and 'id' is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            <span>Suffix</span>
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputweek')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and prefix/suffix.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            <span>Suffix</span>
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputweek')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and prefix/suffix.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-test="value">
            HTML,
            InputWeek::tag()->id('inputweek')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="Select week">
            HTML,
            InputWeek::tag()->id('inputweek')->addAttribute(GlobalAttribute::TITLE, 'Select week')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-week="value">
            HTML,
            InputWeek::tag()->id('inputweek')->addDataAttribute('week', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="test">
            HTML,
            InputWeek::tag()->id('inputweek')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-controls="week-picker" aria-label="Select a week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->ariaAttributes([
                    'controls' => 'week-picker',
                    'label' => 'Select a week',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="week-input" id="inputweek" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->attributes(['class' => 'week-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="inputweek-help">
            HTML,
            InputWeek::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()->autocomplete('on')->id('inputweek')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()->autocomplete(Autocomplete::ON)->id('inputweek')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autofocus>
            HTML,
            InputWeek::tag()->autofocus(true)->id('inputweek')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="week-input" id="inputweek" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->class('week-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-week="value">
            HTML,
            InputWeek::tag()->id('inputweek')->dataAttributes(['week' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag(['class' => 'default-class'])->id('inputweek')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week" title="default-title">
            HTML,
            InputWeek::tag()->id('inputweek')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()->id('inputweek')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()->id('inputweek')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" disabled>
            HTML,
            InputWeek::tag()->id('inputweek')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" form="form-id">
            HTML,
            InputWeek::tag()->form('form-id')->id('inputweek')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputWeek::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputweek-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputWeek::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputWeek::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputWeek::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" hidden>
            HTML,
            InputWeek::tag()->id('inputweek')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="week-input" type="week">
            HTML,
            InputWeek::tag()->id('week-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()->id('inputweek')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()->id('inputweek')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" list="weeks">
            HTML,
            InputWeek::tag()->id('inputweek')->list('weeks')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" max="2018-W26">
            HTML,
            InputWeek::tag()->id('inputweek')->max('2018-W26')->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W18">
            HTML,
            InputWeek::tag()->id('inputweek')->min('2018-W18')->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W01" max="2018-W52">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->min('2018-W01')
                ->max('2018-W52')
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" name="camp-week" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->name('camp-week')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" readonly>
            HTML,
            InputWeek::tag()->id('inputweek')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
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
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
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
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->addDataAttribute('value', 'test')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" required>
            HTML,
            InputWeek::tag()->id('inputweek')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()->id('inputweek')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()->id('inputweek')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="2">
            HTML,
            InputWeek::tag()->id('inputweek')->step(2)->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="any">
            HTML,
            InputWeek::tag()->id('inputweek')->step('any')->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" style='width: 200px;'>
            HTML,
            InputWeek::tag()->id('inputweek')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" tabindex="1">
            HTML,
            InputWeek::tag()->id('inputweek')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputweek" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="Select a week">
            HTML,
            InputWeek::tag()->id('inputweek')->title('Select a week')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="week">
            HTML,
            InputWeek::tag()
                ->id(null)
                ->render(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()->id('inputweek')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()->id('inputweek')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputWeek::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputWeek::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputWeek::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" value="2017-W01">
            HTML,
            InputWeek::tag()->id('inputweek')->value('2017-W01')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
