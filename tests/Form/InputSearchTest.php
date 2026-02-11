<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputSearch;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputSearch} search input behavior.
 *
 * Test coverage.
 * - Applies input-search-specific attributes (`autocomplete`, `autofocus`, `dirname`, `disabled`, `form`, `list`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`,
 *   `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputSearch} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputSearchTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputSearch::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" accesskey="k">
            HTML,
            InputSearch::tag()->id('inputsearch')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-label="Search">
            HTML,
            InputSearch::tag()->id('inputsearch')->addAriaAttribute('label', 'Search')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-hidden="true">
            HTML,
            InputSearch::tag()->id('inputsearch')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="custom-help">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()
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
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            <span>Suffix</span>
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputsearch')
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
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputsearch')
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
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            <span>Suffix</span>
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputsearch')
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
            <input id="inputsearch" type="search" data-test="value">
            HTML,
            InputSearch::tag()->id('inputsearch')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="Search here">
            HTML,
            InputSearch::tag()->id('inputsearch')->addAttribute(GlobalAttribute::TITLE, 'Search here')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-search="value">
            HTML,
            InputSearch::tag()->id('inputsearch')->addDataAttribute('search', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="test">
            HTML,
            InputSearch::tag()->id('inputsearch')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-controls="search-results" aria-label="Search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->ariaAttributes([
                    'controls' => 'search-results',
                    'label' => 'Search',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="search-input" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()->id('inputsearch')->attributes(['class' => 'search-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-help">
            HTML,
            InputSearch::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()->autocomplete('on')->id('inputsearch')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()->autocomplete(Autocomplete::ON)->id('inputsearch')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autofocus>
            HTML,
            InputSearch::tag()->autofocus(true)->id('inputsearch')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="search-input" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()->id('inputsearch')->class('search-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-search="value">
            HTML,
            InputSearch::tag()->id('inputsearch')->dataAttributes(['search' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag(['class' => 'default-class'])->id('inputsearch')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search" title="default-title">
            HTML,
            InputSearch::tag()->id('inputsearch')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()->id('inputsearch')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()->id('inputsearch')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dirname="search.dir">
            HTML,
            InputSearch::tag()->dirname('search.dir')->id('inputsearch')->render(),
            "Failed asserting that element renders correctly with 'dirname' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()->id('inputsearch')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" disabled>
            HTML,
            InputSearch::tag()->id('inputsearch')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" form="form-id">
            HTML,
            InputSearch::tag()->form('form-id')->id('inputsearch')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputSearch::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputsearch-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputSearch::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputSearch::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" hidden>
            HTML,
            InputSearch::tag()->id('inputsearch')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="search-input" type="search">
            HTML,
            InputSearch::tag()->id('search-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()->id('inputsearch')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()->id('inputsearch')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" list="search-list">
            HTML,
            InputSearch::tag()->id('inputsearch')->list('search-list')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" maxlength="10">
            HTML,
            InputSearch::tag()->id('inputsearch')->maxlength(10)->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" minlength="3">
            HTML,
            InputSearch::tag()->id('inputsearch')->minlength(3)->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" name="search" type="search">
            HTML,
            InputSearch::tag()->id('inputsearch')->name('search')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" pattern="search.*">
            HTML,
            InputSearch::tag()->id('inputsearch')->pattern('search.*')->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" placeholder="Search...">
            HTML,
            InputSearch::tag()->id('inputsearch')->placeholder('Search...')->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" readonly>
            HTML,
            InputSearch::tag()->id('inputsearch')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search" required>
            HTML,
            InputSearch::tag()->id('inputsearch')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()->id('inputsearch')->role('searchbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()->id('inputsearch')->role(Role::SEARCHBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" size="20">
            HTML,
            InputSearch::tag()->id('inputsearch')->size(20)->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" spellcheck="true">
            HTML,
            InputSearch::tag()->id('inputsearch')->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" style='width: 200px;'>
            HTML,
            InputSearch::tag()->id('inputsearch')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" tabindex="1">
            HTML,
            InputSearch::tag()->id('inputsearch')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()->id('inputsearch')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="Search here">
            HTML,
            InputSearch::tag()->id('inputsearch')->title('Search here')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            (string) InputSearch::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" translate="no">
            HTML,
            InputSearch::tag()->id('inputsearch')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" translate="no">
            HTML,
            InputSearch::tag()->id('inputsearch')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputSearch::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="search">
            HTML,
            InputSearch::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(InputSearch::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" value="PHP">
            HTML,
            InputSearch::tag()->id('inputsearch')->value('PHP')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
