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
use UIAwesome\Html\Form\InputWeek;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputWeek} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input week specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
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
            'value',
            InputWeek::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'id' => null,
                'type' => Type::WEEK,
                'class' => 'value',
            ],
            InputWeek::tag()
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
            <input id="inputweek" type="week" accesskey="value">
            HTML,
            InputWeek::tag()
                ->accesskey('value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-label="value">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-label="value">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-describedby="value">
            HTML,
            InputWeek::tag()
                ->addAriaAttribute('describedby', 'value')
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and 'id'"
            . " is 'null'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputWeek::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" aria-controls="value" aria-label="value">
            HTML,
            InputWeek::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputweek')
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->attributes(['class' => 'value'])
                ->id('inputweek')
                ->render(),
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
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
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()
                ->autocomplete('on')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autocomplete="on">
            HTML,
            InputWeek::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" autofocus>
            HTML,
            InputWeek::tag()
                ->autofocus(true)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->class('value')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->class(BackedString::VALUE)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" data-value="value">
            HTML,
            InputWeek::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag(['class' => 'default-class'])
                ->id('inputweek')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week" title="default-title">
            HTML,
            InputWeek::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputweek')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()
                ->dir('ltr')
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" dir="ltr">
            HTML,
            InputWeek::tag()
                ->dir(Direction::LTR)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" disabled>
            HTML,
            InputWeek::tag()
                ->disabled(true)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputWeek::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" form="value">
            HTML,
            InputWeek::tag()
                ->form('value')
                ->id('inputweek')
                ->render(),
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
        SimpleFactory::setDefaults(
            InputWeek::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputWeek::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" hidden>
            HTML,
            InputWeek::tag()
                ->hidden(true)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" lang="en">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" list="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" max="2018-W26">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->max('2018-W26')
                ->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W18">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->min('2018-W18')
                ->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" min="2018-W18" max="2018-W26">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->min('2018-W18')
                ->max('2018-W26')
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" name="value" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" readonly>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->readonly(true)
                ->render(),
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
                ->addAriaAttribute('label', 'value')
                ->id('inputweek')
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
                ->setAttribute('class', 'value')
                ->id('inputweek')
                ->removeAttribute('class')
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
                ->addDataAttribute('value', 'value')
                ->id('inputweek')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputweek')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" required>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->role('textbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" role="textbox">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->role(Role::TEXTBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="2">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->step(2)
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" step="any">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->step('any')
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" style='value'>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" tabindex="1">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
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
            <input id="inputweek" type="week">
            </div>
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and custom template.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputweek" type="week">
            HTML,
            InputWeek::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputweek')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" title="value">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="week">
            HTML,
            (string) InputWeek::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" translate="no">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputWeek::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="week">
            HTML,
            InputWeek::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputWeek::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week" value="2018-W18">
            HTML,
            InputWeek::tag()
                ->id('inputweek')
                ->value('2018-W18')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
