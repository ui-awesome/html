<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Attribute,
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
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
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
                'type' => Type::SEARCH,
                'class' => 'value',
            ],
            InputSearch::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" accesskey="value">
            HTML,
            InputSearch::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" aria-label="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" aria-describedby="value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', 'value')
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
            <input type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" aria-controls="value" aria-label="value">
            HTML,
            InputSearch::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
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

    public function testRenderWithAriaDescribedByCustomSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsearch" type="search" aria-describedby="inputsearch-value">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('describedby', true)
                ->ariaDescribedBySuffix('value')
                ->id('inputsearch')
                ->render(),
            "Failed asserting that 'ariaDescribedBySuffix()' correctly applies the custom suffix.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="search">
            HTML,
            InputSearch::tag()
                ->attributes(['class' => 'value'])
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
            <input type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete('on')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" autocomplete="on">
            HTML,
            InputSearch::tag()
                ->autocomplete(Autocomplete::ON)
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" autofocus>
            HTML,
            InputSearch::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="search">
            HTML,
            InputSearch::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="search">
            HTML,
            InputSearch::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" data-value="value">
            HTML,
            InputSearch::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="search">
            HTML,
            InputSearch::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" type="search" title="default-title">
            HTML,
            InputSearch::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" dirname="search.dir">
            HTML,
            InputSearch::tag()
                ->dirname('search.dir')
                ->render(),
            "Failed asserting that element renders correctly with 'dirname' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" dir="ltr">
            HTML,
            InputSearch::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" disabled>
            HTML,
            InputSearch::tag()
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputSearch::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" form="value">
            HTML,
            InputSearch::tag()
                ->form('value')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
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
            <input class="default-class" type="search">
            HTML,
            InputSearch::tag()->render(),
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
            <input type="search" hidden>
            HTML,
            InputSearch::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="value" type="search">
            HTML,
            InputSearch::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" lang="en">
            HTML,
            InputSearch::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" list="value">
            HTML,
            InputSearch::tag()
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" maxlength="10">
            HTML,
            InputSearch::tag()
                ->maxlength(10)
                ->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" minlength="3">
            HTML,
            InputSearch::tag()
                ->minlength(3)
                ->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value" type="search">
            HTML,
            InputSearch::tag()
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" pattern="search.*">
            HTML,
            InputSearch::tag()
                ->pattern('search.*')
                ->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" placeholder="value">
            HTML,
            InputSearch::tag()
                ->placeholder('value')
                ->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" readonly>
            HTML,
            InputSearch::tag()
                ->readonly(true)
                ->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search">
            HTML,
            InputSearch::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" required>
            HTML,
            InputSearch::tag()
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->role('searchbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" role="searchbox">
            HTML,
            InputSearch::tag()
                ->role(Role::SEARCHBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" type="search">
            HTML,
            InputSearch::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" title="value">
            HTML,
            InputSearch::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" size="20">
            HTML,
            InputSearch::tag()
                ->size(20)
                ->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" spellcheck="true">
            HTML,
            InputSearch::tag()
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" style='value'>
            HTML,
            InputSearch::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" tabindex="1">
            HTML,
            InputSearch::tag()
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
            <input type="search">
            </div>
            HTML,
            InputSearch::tag()
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" type="search">
            HTML,
            InputSearch::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" title="value">
            HTML,
            InputSearch::tag()
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
            (string) InputSearch::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" translate="no">
            HTML,
            InputSearch::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input type="search" translate="no">
            HTML,
            InputSearch::tag()
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
            <input type="search" value="value">
            HTML,
            InputSearch::tag()
                ->value('value')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeArray(Direction::cases())),
            ),
        );

        InputSearch::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeArray(Language::cases())),
            ),
        );

        InputSearch::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMaxlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MAXLENGTH->value,
                'value >= 0',
            ),
        );

        InputSearch::tag()->maxlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingMinlength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-1',
                Attribute::MINLENGTH->value,
                'value >= 0',
            ),
        );

        InputSearch::tag()->minlength(-1);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeArray(Role::cases())),
            ),
        );

        InputSearch::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        InputSearch::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        InputSearch::tag()->translate('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TYPE->value,
                implode("', '", Enum::normalizeArray(Type::cases())),
            ),
        );

        InputSearch::tag()->type('invalid-value');
    }
}
