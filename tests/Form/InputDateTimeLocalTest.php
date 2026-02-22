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
use UIAwesome\Html\Form\InputDateTimeLocal;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputDateTimeLocal} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input datetimelocal specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`,
 *   `min`, `name`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputDateTimeLocalTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputDateTimeLocal::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'id' => null,
                'type' => Type::DATETIME_LOCAL,
                'class' => 'value',
            ],
            InputDateTimeLocal::tag()
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
            <input id="inputdatetimelocal" type="datetime-local" accesskey="value">
            HTML,
            InputDateTimeLocal::tag()
                ->accesskey('value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-label="value">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-label="value">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="value">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
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
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            <span>Suffix</span>
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputdatetimelocal')
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
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            <span>Suffix</span>
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputdatetimelocal')
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
            <input id="inputdatetimelocal" type="datetime-local" data-value="value">
            HTML,
            InputDateTimeLocal::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" data-value="value">
            HTML,
            InputDateTimeLocal::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputDateTimeLocal::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-controls="value" aria-label="value">
            HTML,
            InputDateTimeLocal::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->attributes(['class' => 'value'])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" aria-describedby="inputdatetimelocal-help">
            HTML,
            InputDateTimeLocal::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" autocomplete="on">
            HTML,
            InputDateTimeLocal::tag()
                ->autocomplete('on')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" autocomplete="on">
            HTML,
            InputDateTimeLocal::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" autofocus>
            HTML,
            InputDateTimeLocal::tag()
                ->autofocus(true)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->class('value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->class(BackedString::VALUE)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" data-value="value">
            HTML,
            InputDateTimeLocal::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag(['class' => 'default-class'])
                ->id('inputdatetimelocal')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdatetimelocal" type="datetime-local" title="default-title">
            HTML,
            InputDateTimeLocal::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputdatetimelocal')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" dir="ltr">
            HTML,
            InputDateTimeLocal::tag()
                ->dir('ltr')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" dir="ltr">
            HTML,
            InputDateTimeLocal::tag()
                ->dir(Direction::LTR)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" disabled>
            HTML,
            InputDateTimeLocal::tag()
                ->disabled(true)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputDateTimeLocal::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" form="value">
            HTML,
            InputDateTimeLocal::tag()
                ->form('value')
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputDateTimeLocal::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputdatetimelocal-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputDateTimeLocal::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputDateTimeLocal::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" hidden>
            HTML,
            InputDateTimeLocal::tag()
                ->hidden(true)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" lang="en">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" lang="en">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" list="value">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" max="2018-06-14T00:00">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->max('2018-06-14T00:00')
                ->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" min="2018-06-07T00:00">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->min('2018-06-07T00:00')
                ->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" min="2018-06-07T00:00" max="2018-06-14T00:00">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->min('2018-06-07T00:00')
                ->max('2018-06-14T00:00')
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" name="value" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" readonly>
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->readonly(true)
                ->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputdatetimelocal')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->setAttribute('class', 'value')
                ->id('inputdatetimelocal')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputdatetimelocal')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputdatetimelocal')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" required>
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" role="textbox">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->role('textbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" role="textbox">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->role(Role::TEXTBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" title="value">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" step="2">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->step(2)
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" step="any">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->step('any')
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" style='value'>
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" tabindex="1">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
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
            <input id="inputdatetimelocal" type="datetime-local">
            </div>
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputdatetimelocal')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" title="value">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="datetime-local">
            HTML,
            (string) InputDateTimeLocal::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" translate="no">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" translate="no">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputDateTimeLocal::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputDateTimeLocal::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local" value="2018-06-07T00:00">
            HTML,
            InputDateTimeLocal::tag()
                ->id('inputdatetimelocal')
                ->value('2018-06-07T00:00')
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

        InputDateTimeLocal::tag()->dir('invalid-value');
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

        InputDateTimeLocal::tag()->lang('invalid-value');
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

        InputDateTimeLocal::tag()->role('invalid-value');
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

        InputDateTimeLocal::tag()->tabIndex(-2);
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

        InputDateTimeLocal::tag()->translate('invalid-value');
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

        InputDateTimeLocal::tag()->type('invalid-value');
    }
}
