<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputTel;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputTel} class.
 *
 * Test coverage.
 *
 * - Applies input-tel-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `maxlength`,
 *   `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`, `tabindex`, `value`)
 *   and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputTel} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputTelTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputTel::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" accesskey="k">
            HTML,
            InputTel::tag()->id('inputtel')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-label="Phone selector">
            HTML,
            InputTel::tag()->id('inputtel')->addAriaAttribute('label', 'Phone selector')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-hidden="true">
            HTML,
            InputTel::tag()->id('inputtel')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="custom-help">
            HTML,
            InputTel::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputtel')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtel')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="tel">
            HTML,
            InputTel::tag()
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
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            <span>Suffix</span>
            HTML,
            InputTel::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtel')
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
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtel')
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
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            <span>Suffix</span>
            HTML,
            InputTel::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtel')
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
            <input id="inputtel" type="tel" data-test="value">
            HTML,
            InputTel::tag()->id('inputtel')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" title="Select phone">
            HTML,
            InputTel::tag()->id('inputtel')->addAttribute(GlobalAttribute::TITLE, 'Select phone')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" data-tel="value">
            HTML,
            InputTel::tag()->id('inputtel')->addDataAttribute('tel', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" data-value="test">
            HTML,
            InputTel::tag()->id('inputtel')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-controls="phone-picker" aria-label="Select a phone">
            HTML,
            InputTel::tag()
                ->id('inputtel')
                ->ariaAttributes([
                    'controls' => 'phone-picker',
                    'label' => 'Select a phone',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputtel')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputtel')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="tel-input" id="inputtel" type="tel">
            HTML,
            InputTel::tag()->id('inputtel')->attributes(['class' => 'tel-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputtel')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" aria-describedby="inputtel-help">
            HTML,
            InputTel::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputtel')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" autocomplete="on">
            HTML,
            InputTel::tag()->autocomplete('on')->id('inputtel')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" autocomplete="on">
            HTML,
            InputTel::tag()->autocomplete(Autocomplete::ON)->id('inputtel')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" autofocus>
            HTML,
            InputTel::tag()->autofocus(true)->id('inputtel')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="tel-input" id="inputtel" type="tel">
            HTML,
            InputTel::tag()->id('inputtel')->class('tel-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" data-tel="value">
            HTML,
            InputTel::tag()->id('inputtel')->dataAttributes(['tel' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtel" type="tel">
            HTML,
            InputTel::tag(['class' => 'default-class'])->id('inputtel')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtel" type="tel" title="default-title">
            HTML,
            InputTel::tag()->id('inputtel')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel">
            HTML,
            InputTel::tag()->id('inputtel')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" dir="ltr">
            HTML,
            InputTel::tag()->id('inputtel')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" dir="ltr">
            HTML,
            InputTel::tag()->id('inputtel')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" disabled>
            HTML,
            InputTel::tag()->id('inputtel')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" form="form-id">
            HTML,
            InputTel::tag()->form('form-id')->id('inputtel')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputTel::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputtel-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputTel::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputTel::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputTel::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" hidden>
            HTML,
            InputTel::tag()->id('inputtel')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="tel-input" type="tel">
            HTML,
            InputTel::tag()->id('tel-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" lang="en">
            HTML,
            InputTel::tag()->id('inputtel')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" lang="en">
            HTML,
            InputTel::tag()->id('inputtel')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" list="phones">
            HTML,
            InputTel::tag()->id('inputtel')->list('phones')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" maxlength="10">
            HTML,
            InputTel::tag()->id('inputtel')->maxlength(10)->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" minlength="5">
            HTML,
            InputTel::tag()->id('inputtel')->minlength(5)->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" name="phone" type="tel">
            HTML,
            InputTel::tag()->id('inputtel')->name('phone')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}'>
            HTML,
            InputTel::tag()->id('inputtel')->pattern('[0-9]{3}-[0-9]{3}-[0-9]{4}')->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" placeholder="123-456-7890">
            HTML,
            InputTel::tag()->id('inputtel')->placeholder('123-456-7890')->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" readonly>
            HTML,
            InputTel::tag()->id('inputtel')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel">
            HTML,
            InputTel::tag()
                ->id('inputtel')
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
            <input id="inputtel" type="tel">
            HTML,
            InputTel::tag()
                ->id('inputtel')
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
            <input id="inputtel" type="tel">
            HTML,
            InputTel::tag()
                ->id('inputtel')
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
            <input id="inputtel" type="tel" required>
            HTML,
            InputTel::tag()->id('inputtel')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" role="textbox">
            HTML,
            InputTel::tag()->id('inputtel')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" role="textbox">
            HTML,
            InputTel::tag()->id('inputtel')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" size="30">
            HTML,
            InputTel::tag()->id('inputtel')->size(30)->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" spellcheck="true">
            HTML,
            InputTel::tag()->id('inputtel')->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" style='width: 200px;'>
            HTML,
            InputTel::tag()->id('inputtel')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" tabindex="1">
            HTML,
            InputTel::tag()->id('inputtel')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputtel" type="tel">
            HTML,
            InputTel::tag()->id('inputtel')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" title="Select a phone">
            HTML,
            InputTel::tag()->id('inputtel')->title('Select a phone')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="tel">
            HTML,
            InputTel::tag()
                ->id(null)
                ->render(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" translate="no">
            HTML,
            InputTel::tag()->id('inputtel')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" translate="no">
            HTML,
            InputTel::tag()->id('inputtel')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputTel::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputTel::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputTel::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtel" type="tel" value="123-456-7890">
            HTML,
            InputTel::tag()->id('inputtel')->value('123-456-7890')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
