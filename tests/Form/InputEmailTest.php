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
use UIAwesome\Html\Form\InputEmail;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputEmail} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input email specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `maxlength`,
 *   `minlength`, `multiple`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`,
 *   `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputEmailTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputEmail::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::EMAIL,
                'class' => 'value',
            ],
            InputEmail::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" accesskey="value">
            HTML,
            InputEmail::tag()
                ->accesskey('value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-label="value">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-label="value">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="value">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="email">
            HTML,
            InputEmail::tag()
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
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            <span>Suffix</span>
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputemail')
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
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            <span>Suffix</span>
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputemail')
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
            <input id="inputemail" type="email" data-value="value">
            HTML,
            InputEmail::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" data-value="value">
            HTML,
            InputEmail::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputEmail::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-controls="value" aria-label="value">
            HTML,
            InputEmail::tag()
                ->attributes(
                    [
                        'aria-controls' => 'value',
                        'aria-label' => 'value',
                    ],
                )
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->attributes(['class' => 'value'])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" aria-describedby="inputemail-help">
            HTML,
            InputEmail::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" autocomplete="on">
            HTML,
            InputEmail::tag()
                ->autocomplete('on')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" autocomplete="on">
            HTML,
            InputEmail::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" autofocus>
            HTML,
            InputEmail::tag()
                ->autofocus(true)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->class('value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->class(BackedString::VALUE)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" data-value="value">
            HTML,
            InputEmail::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputemail" type="email">
            HTML,
            InputEmail::tag(['class' => 'default-class'])
                ->id('inputemail')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputemail" type="email" title="default-title">
            HTML,
            InputEmail::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputemail')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" dir="ltr">
            HTML,
            InputEmail::tag()
                ->dir('ltr')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" dir="ltr">
            HTML,
            InputEmail::tag()
                ->dir(Direction::LTR)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" disabled>
            HTML,
            InputEmail::tag()
                ->disabled(true)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputEmail::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" form="value">
            HTML,
            InputEmail::tag()
                ->form('value')
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputEmail::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputEmail::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" hidden>
            HTML,
            InputEmail::tag()
                ->hidden(true)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" lang="en">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" lang="en">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" list="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" maxlength="255">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->maxlength(255)
                ->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" minlength="5">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->minlength(5)
                ->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" multiple>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->multiple(true)
                ->render(),
            "Failed asserting that element renders correctly with 'multiple' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" name="value" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" pattern=".+@example\.com">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->pattern('.+@example\\.com')
                ->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" placeholder="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->placeholder('value')
                ->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" readonly>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->readonly(true)
                ->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputemail')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->setAttribute('class', 'value')
                ->id('inputemail')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputemail')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputemail')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" required>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" role="textbox">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->role('textbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" role="textbox">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->role(Role::TEXTBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" title="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" size="30">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->size(30)
                ->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" spellcheck="true">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" style='value'>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" tabindex="1">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
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
            <input id="inputemail" type="email">
            </div>
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputemail" type="email">
            HTML,
            InputEmail::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputemail')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" title="value">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="email">
            HTML,
            (string) InputEmail::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" translate="no">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" translate="no">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputEmail::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="email">
            HTML,
            InputEmail::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputEmail::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputemail" type="email" value="hello@example.com">
            HTML,
            InputEmail::tag()
                ->id('inputemail')
                ->value('hello@example.com')
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

        InputEmail::tag()->dir('invalid-value');
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

        InputEmail::tag()->lang('invalid-value');
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

        InputEmail::tag()->maxlength(-1);
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

        InputEmail::tag()->minlength(-1);
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

        InputEmail::tag()->role('invalid-value');
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

        InputEmail::tag()->tabIndex(-2);
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

        InputEmail::tag()->translate('invalid-value');
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

        InputEmail::tag()->type('invalid-value');
    }
}
