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
use UIAwesome\Html\Form\InputSearch;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputSearch} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input search specific attributes (`autocomplete`, `autofocus`, `dirname`, `disabled`, `form`, `list`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`,
 *   `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
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
            'value',
            InputSearch::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'id' => null,
                'type' => Type::SEARCH,
                'class' => 'value',
            ],
            InputSearch::tag()
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
            <input id="inputsearch" type="search" accesskey="value">
            HTML,
            InputSearch::tag()
                ->accesskey('value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', 'value')
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-controls="value" aria-label="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->ariaAttributes([
                    'controls' => 'value',
                    'label' => 'value',
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->attributes(['class' => 'value'])
                ->id('inputsearch')
                ->render(),
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete('on')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" autofocus>
            HTML,
            InputSearch::tag()
                ->autofocus(true)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->class('value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->class(BackedString::VALUE)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search">
            HTML,
            InputSearch::tag(['class' => 'default-class'])
                ->id('inputsearch')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsearch" type="search" title="default-title">
            HTML,
            InputSearch::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputsearch')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir('ltr')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dirname="search.dir">
            HTML,
            InputSearch::tag()
                ->dirname('search.dir')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'dirname' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir(Direction::LTR)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" disabled>
            HTML,
            InputSearch::tag()
                ->disabled(true)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputSearch::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" form="value">
            HTML,
            InputSearch::tag()
                ->form('value')
                ->id('inputsearch')
                ->render(),
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
            InputSearch::tag()
                ->hidden(true)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" list="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" maxlength="10">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->maxlength(10)
                ->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" minlength="3">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->minlength(3)
                ->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" name="value" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" pattern="search.*">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->pattern('search.*')
                ->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" placeholder="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->placeholder('value')
                ->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" readonly>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->readonly(true)
                ->render(),
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
                ->addAriaAttribute('label', 'value')
                ->id('inputsearch')
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
                ->setAttribute('class', 'value')
                ->id('inputsearch')
                ->removeAttribute('class')
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
                ->addDataAttribute('value', 'value')
                ->id('inputsearch')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputsearch')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" required>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->role('searchbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->role(Role::SEARCHBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" size="20">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->size(20)
                ->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" spellcheck="true">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" style='value'>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" tabindex="1">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
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
            <input id="inputsearch" type="search">
            </div>
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsearch" type="search">
            HTML,
            InputSearch::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputsearch')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" title="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->title('value')
                ->render(),
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
            InputSearch::tag()
                ->id('inputsearch')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" translate="no">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputSearch::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="search">
            HTML,
            InputSearch::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputSearch::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" value="value">
            HTML,
            InputSearch::tag()
                ->id('inputsearch')
                ->value('value')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
