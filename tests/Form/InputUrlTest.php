<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputUrl;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputUrl} class.
 *
 * Test coverage.
 *
 * - Applies input-url-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `maxlength`,
 *   `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`, `tabindex`, `value`)
 *   and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputUrl} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('form')]
final class InputUrlTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputUrl::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" accesskey="k">
            HTML,
            InputUrl::tag()->id('inputurl-')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" aria-label="Url selector">
            HTML,
            InputUrl::tag()->id('inputurl-')->addAriaAttribute('label', 'Url selector')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" aria-hidden="true">
            HTML,
            InputUrl::tag()->id('inputurl-')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" data-test="value">
            HTML,
            InputUrl::tag()->id('inputurl-')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" title="Select url">
            HTML,
            InputUrl::tag()->id('inputurl-')->addAttribute(GlobalAttribute::TITLE, 'Select url')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" data-url="value">
            HTML,
            InputUrl::tag()->id('inputurl-')->addDataAttribute('url', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" data-value="test">
            HTML,
            InputUrl::tag()->id('inputurl-')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" aria-controls="url-picker" aria-label="Select a url">
            HTML,
            InputUrl::tag()
                ->id('inputurl-')
                ->ariaAttributes([
                    'controls' => 'url-picker',
                    'label' => 'Select a url',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="url-input" id="inputurl-" type="url">
            HTML,
            InputUrl::tag()->id('inputurl-')->attributes(['class' => 'url-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" autocomplete="on">
            HTML,
            InputUrl::tag()->autocomplete('on')->id('inputurl-')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" autocomplete="on">
            HTML,
            InputUrl::tag()->autocomplete(Autocomplete::ON)->id('inputurl-')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" autofocus>
            HTML,
            InputUrl::tag()->autofocus(true)->id('inputurl-')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="url-input" id="inputurl-" type="url">
            HTML,
            InputUrl::tag()->id('inputurl-')->class('url-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" data-url="value">
            HTML,
            InputUrl::tag()->id('inputurl-')->dataAttributes(['url' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl-" type="url">
            HTML,
            InputUrl::tag(['class' => 'default-class'])->id('inputurl-')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputurl-" type="url" title="default-title">
            HTML,
            InputUrl::tag()->id('inputurl-')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-">
            HTML,
            InputUrl::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" dir="ltr">
            HTML,
            InputUrl::tag()->id('inputurl-')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" dir="ltr">
            HTML,
            InputUrl::tag()->id('inputurl-')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" disabled>
            HTML,
            InputUrl::tag()->id('inputurl-')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" form="form-id">
            HTML,
            InputUrl::tag()->form('form-id')->id('inputurl-')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputUrl::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputUrl::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputUrl::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" hidden>
            HTML,
            InputUrl::tag()->id('inputurl-')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="url-input" type="url">
            HTML,
            InputUrl::tag()->id('url-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" lang="en">
            HTML,
            InputUrl::tag()->id('inputurl-')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" lang="en">
            HTML,
            InputUrl::tag()->id('inputurl-')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" list="urls">
            HTML,
            InputUrl::tag()->id('inputurl-')->list('urls')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" maxlength="10">
            HTML,
            InputUrl::tag()->id('inputurl-')->maxlength(10)->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" minlength="5">
            HTML,
            InputUrl::tag()->id('inputurl-')->minlength(5)->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" name="website" type="url">
            HTML,
            InputUrl::tag()->id('inputurl-')->name('website')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" pattern="https://.*">
            HTML,
            InputUrl::tag()->id('inputurl-')->pattern('https://.*')->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" placeholder="https://example.com">
            HTML,
            InputUrl::tag()->id('inputurl-')->placeholder('https://example.com')->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" readonly>
            HTML,
            InputUrl::tag()->id('inputurl-')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl-')
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
            <input id="inputurl-" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl-')
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
            <input id="inputurl-" type="url">
            HTML,
            InputUrl::tag()
                ->id('inputurl-')
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
            <input id="inputurl-" type="url" required>
            HTML,
            InputUrl::tag()->id('inputurl-')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" role="textbox">
            HTML,
            InputUrl::tag()->id('inputurl-')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" role="textbox">
            HTML,
            InputUrl::tag()->id('inputurl-')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" size="30">
            HTML,
            InputUrl::tag()->id('inputurl-')->size(30)->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" spellcheck="true">
            HTML,
            InputUrl::tag()->id('inputurl-')->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" style='width: 200px;'>
            HTML,
            InputUrl::tag()->id('inputurl-')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" tabindex="1">
            HTML,
            InputUrl::tag()->id('inputurl-')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputurl-" type="url">
            HTML,
            InputUrl::tag()->id('inputurl-')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" title="Select a url">
            HTML,
            InputUrl::tag()->id('inputurl-')->title('Select a url')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertStringContainsString(
            'type="url"',
            LineEndingNormalizer::normalize((string) InputUrl::tag()),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" translate="no">
            HTML,
            InputUrl::tag()->id('inputurl-')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" translate="no">
            HTML,
            InputUrl::tag()->id('inputurl-')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputUrl::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputUrl::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputUrl::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputurl-" type="url" value="https://example.com">
            HTML,
            InputUrl::tag()->id('inputurl-')->value('https://example.com')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
