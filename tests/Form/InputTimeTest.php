<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputTime;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputTime} time input behavior.
 *
 * Test coverage.
 * - Applies input-time-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
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
            'default',
            InputTime::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" accesskey="k">
            HTML,
            InputTime::tag()->id('inputtime')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-label="Time selector">
            HTML,
            InputTime::tag()->id('inputtime')->addAriaAttribute('label', 'Time selector')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-hidden="true">
            HTML,
            InputTime::tag()->id('inputtime')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="custom-help">
            HTML,
            InputTime::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputtime')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtime')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="time">
            HTML,
            InputTime::tag()
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
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            <span>Suffix</span>
            HTML,
            InputTime::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtime')
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
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtime')
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
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            <span>Suffix</span>
            HTML,
            InputTime::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtime')
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
            <input id="inputtime" type="time" data-test="value">
            HTML,
            InputTime::tag()->id('inputtime')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" title="Select time">
            HTML,
            InputTime::tag()->id('inputtime')->addAttribute(GlobalAttribute::TITLE, 'Select time')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-time="value">
            HTML,
            InputTime::tag()->id('inputtime')->addDataAttribute('time', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-value="test">
            HTML,
            InputTime::tag()->id('inputtime')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-controls="time-picker" aria-label="Select a time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->ariaAttributes([
                    'controls' => 'time-picker',
                    'label' => 'Select a time',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputtime')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputtime')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="time-input" id="inputtime" type="time">
            HTML,
            InputTime::tag()->id('inputtime')->attributes(['class' => 'time-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputtime')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" aria-describedby="inputtime-help">
            HTML,
            InputTime::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputtime')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autocomplete="on">
            HTML,
            InputTime::tag()->autocomplete('on')->id('inputtime')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autocomplete="on">
            HTML,
            InputTime::tag()->autocomplete(Autocomplete::ON)->id('inputtime')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" autofocus>
            HTML,
            InputTime::tag()->autofocus(true)->id('inputtime')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="time-input" id="inputtime" type="time">
            HTML,
            InputTime::tag()->id('inputtime')->class('time-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" data-time="value">
            HTML,
            InputTime::tag()->id('inputtime')->dataAttributes(['time' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time">
            HTML,
            InputTime::tag(['class' => 'default-class'])->id('inputtime')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time" title="default-title">
            HTML,
            InputTime::tag()->id('inputtime')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()->id('inputtime')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" dir="ltr">
            HTML,
            InputTime::tag()->id('inputtime')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" dir="ltr">
            HTML,
            InputTime::tag()->id('inputtime')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" disabled>
            HTML,
            InputTime::tag()->id('inputtime')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" form="form-id">
            HTML,
            InputTime::tag()->form('form-id')->id('inputtime')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputTime::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputtime-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputTime::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputTime::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputTime::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" hidden>
            HTML,
            InputTime::tag()->id('inputtime')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="time-input" type="time">
            HTML,
            InputTime::tag()->id('time-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" lang="en">
            HTML,
            InputTime::tag()->id('inputtime')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" lang="en">
            HTML,
            InputTime::tag()->id('inputtime')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" list="times">
            HTML,
            InputTime::tag()->id('inputtime')->list('times')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" max="18:00">
            HTML,
            InputTime::tag()->id('inputtime')->max('18:00')->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" min="09:00">
            HTML,
            InputTime::tag()->id('inputtime')->min('09:00')->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
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
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" name="alarm" type="time">
            HTML,
            InputTime::tag()->id('inputtime')->name('alarm')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" readonly>
            HTML,
            InputTime::tag()->id('inputtime')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
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
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
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
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
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
            <input id="inputtime" type="time" required>
            HTML,
            InputTime::tag()->id('inputtime')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" role="textbox">
            HTML,
            InputTime::tag()->id('inputtime')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" role="textbox">
            HTML,
            InputTime::tag()->id('inputtime')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" step="2">
            HTML,
            InputTime::tag()->id('inputtime')->step(2)->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" step="any">
            HTML,
            InputTime::tag()->id('inputtime')->step('any')->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" style='width: 200px;'>
            HTML,
            InputTime::tag()->id('inputtime')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" tabindex="1">
            HTML,
            InputTime::tag()->id('inputtime')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputtime" type="time">
            HTML,
            InputTime::tag()->id('inputtime')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" title="Select a time">
            HTML,
            InputTime::tag()->id('inputtime')->title('Select a time')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="time">
            HTML,
            InputTime::tag()
                ->id(null)
                ->render(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" translate="no">
            HTML,
            InputTime::tag()->id('inputtime')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" translate="no">
            HTML,
            InputTime::tag()->id('inputtime')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputTime::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputTime::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputTime::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time" value="14:30">
            HTML,
            InputTime::tag()->id('inputtime')->value('14:30')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
