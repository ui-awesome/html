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
use UIAwesome\Html\Form\InputNumber;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputNumber} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input number specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `list`, `max`, `min`,
 *   `name`, `placeholder`, `readonly`, `required`, `step`, `tabindex`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputNumberTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputNumber::tag()
                ->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'id' => null,
                'type' => Type::NUMBER,
                'class' => 'value',
            ],
            InputNumber::tag()
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
            <input id="inputnumber" type="number" accesskey="value">
            HTML,
            InputNumber::tag()
                ->accesskey('value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-label="value">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-label="value">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="value">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="number">
            HTML,
            InputNumber::tag()
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
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            <span>Suffix</span>
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputnumber')
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
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            <span>Suffix</span>
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputnumber')
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
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputNumber::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-controls="value" aria-label="value">
            HTML,
            InputNumber::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->attributes(['class' => 'value'])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" aria-describedby="inputnumber-help">
            HTML,
            InputNumber::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autocomplete="on">
            HTML,
            InputNumber::tag()
                ->autocomplete('on')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autocomplete="on">
            HTML,
            InputNumber::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" autofocus>
            HTML,
            InputNumber::tag()
                ->autofocus(true)
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->class('value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->class(BackedString::VALUE)
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" data-value="value">
            HTML,
            InputNumber::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number">
            HTML,
            InputNumber::tag(['class' => 'default-class'])
                ->id('inputnumber')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number" title="default-title">
            HTML,
            InputNumber::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputnumber')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" dir="ltr">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" dir="ltr">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" disabled>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->disabled(true)
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputNumber::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" form="value">
            HTML,
            InputNumber::tag()
                ->form('value')
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputNumber::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputnumber-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputNumber::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputNumber::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" hidden>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" lang="en">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" lang="en">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" list="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->list('value')
                ->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->max(100)
                ->render(),
            "Failed asserting that element renders correctly with 'max' attribute.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->render(),
            "Failed asserting that element renders correctly with 'min' attribute.",
        );
    }

    public function testRenderWithMinAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" min="10" max="100">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->min(10)
                ->max(100)
                ->render(),
            "Failed asserting that element renders correctly with both 'min' and 'max' attributes.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" name="value" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" placeholder="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->placeholder('value')
                ->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" readonly>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->readonly(true)
                ->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputnumber')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->setAttribute('class', 'value')
                ->id('inputnumber')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputnumber')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputnumber')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" required>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" role="spinbutton">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->role('spinbutton')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" role="spinbutton">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->role(Role::SPINBUTTON)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" title="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStep(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="2">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step(2)
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute.",
        );
    }

    public function testRenderWithStepAny(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" step="any">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->step('any')
                ->render(),
            "Failed asserting that element renders correctly with 'step' attribute set to 'any'.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" style='value'>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" tabindex="1">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
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
            <input id="inputnumber" type="number">
            </div>
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and custom template.',
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputnumber" type="number">
            HTML,
            InputNumber::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputnumber')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" title="value">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="number">
            HTML,
            (string) InputNumber::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" translate="no">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" translate="no">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputNumber::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="number">
            HTML,
            InputNumber::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(InputNumber::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputnumber" type="number" value="10">
            HTML,
            InputNumber::tag()
                ->id('inputnumber')
                ->value(10)
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
