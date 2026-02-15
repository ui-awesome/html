<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Provider\Form\CheckedProvider;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};
use UnitEnum;

use function str_replace;

/**
 * Unit tests for the {@see InputRadio} class.
 *
 * Test coverage.
 *
 * - Applies input-radio-specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
 *   `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Handles edge cases for `checked` attribute with various data types and value comparisons.
 * - Renders attributes and string casting for a void element.
 * - Renders label configurations, including content, attributes, and tag name.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputRadio} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputRadioTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputRadio::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" accesskey="k">
            HTML,
            InputRadio::tag()
                ->accesskey('k')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-label="Radio selector">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'Radio selector')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-hidden="true">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="custom-help">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputradio')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="radio">
            HTML,
            InputRadio::tag()
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
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            <span>Suffix</span>
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputradio')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' "
            . 'and prefix/suffix.',
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            <span>Suffix</span>
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputradio')
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
            <input id="inputradio" type="radio" data-radio="value">
            HTML,
            InputRadio::tag()
                ->addDataAttribute('radio', 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-value="test">
            HTML,
            InputRadio::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-controls="radio-picker" aria-label="Select a radio">
            HTML,
            InputRadio::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'radio-picker',
                        'label' => 'Select a radio',
                    ],
                )
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="radio-input" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->attributes(['class' => 'radio-input'])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="inputradio-help">
            HTML,
            InputRadio::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" autofocus>
            HTML,
            InputRadio::tag()
                ->autofocus(true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" checked>
            HTML,
            InputRadio::tag()
                ->checked(true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'checked' attribute.",
        );
    }

    /**
     * @phpstan-param mixed[]|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    #[DataProviderExternal(CheckedProvider::class, 'checked')]
    public function testRenderWithCheckedAndValue(
        bool|float|int|string|array|Stringable|UnitEnum|null $checked,
        bool|float|int|string|Stringable|UnitEnum|null $value,
        string $expected,
    ): void {
        // CheckedProvider returns checkbox-flavored expected HTML; adapt for radio.
        $expected = str_replace(
            ['inputcheckbox', 'type="checkbox"'],
            ['inputradio', 'type="radio"'],
            $expected,
        );

        self::assertSame(
            $expected,
            InputRadio::tag()
                ->checked($checked)
                ->id('inputradio')
                ->value($value)
                ->render(),
            "Failed asserting that element renders correctly with 'checked' and 'value' attributes.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="radio-input" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->class('radio-input')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->class(BackedString::VALUE)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-radio="value">
            HTML,
            InputRadio::tag()
                ->dataAttributes(['radio' => 'value'])
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio">
            HTML,
            InputRadio::tag(['class' => 'default-class'])
                ->id('inputradio')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio" title="default-title">
            HTML,
            InputRadio::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputradio')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" dir="ltr">
            HTML,
            InputRadio::tag()
                ->dir('ltr')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" dir="ltr">
            HTML,
            InputRadio::tag()
                ->dir(Direction::LTR)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" disabled>
            HTML,
            InputRadio::tag()
                ->disabled(true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEnclosedByLabel(): void
    {
        self::assertSame(
            <<<HTML
            <label>
            <input id="inputradio" type="radio">
            Label
            </label>
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id('inputradio')
                ->label('Label')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and label content.',
        );
    }

    public function testRenderWithEnclosedByLabelAndCustomTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div class="wrapper">
            <label>
            <input id="inputradio" type="radio">
            Red
            </label>
            </div>
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id('inputradio')
                ->label('Red')
                ->template('<div class="wrapper">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and custom template.',
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelContentEmpty(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id('inputradio')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and empty label content.',
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <label for="label-for">
            <input id="inputradio" type="radio">
            Label
            </label>
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id('inputradio')
                ->label('Label')
                ->labelFor('label-for')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and label "for" attribute.',
        );
    }

    public function testRenderWithEnclosedByLabelIsIdempotent(): void
    {
        $radio = InputRadio::tag()
            ->enclosedByLabel(true)
            ->id('inputradio')
            ->label('Label');

        $first = $radio->render();
        $second = $radio->render();

        self::assertSame(
            $first,
            $second,
            'Rendering the same instance twice should produce identical output.',
        );
    }

    public function testRenderWithEnclosedByLabelWithoutId(): void
    {
        self::assertSame(
            <<<HTML
            <label>
            <input type="radio">
            Red
            </label>
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id(null)
                ->label('Red')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and no ID.',
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" form="form-id">
            HTML,
            InputRadio::tag()
                ->form('form-id')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputRadio::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputradio-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputRadio::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputRadio::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" hidden>
            HTML,
            InputRadio::tag()
                ->hidden(true)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="radio-input" type="radio">
            HTML,
            InputRadio::tag()
                ->id('radio-input')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->render(),
            'Failed asserting that element renders correctly with label.',
        );
    }

    public function testRenderWithLabelAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->render(),
            'Failed asserting that element renders correctly with label attributes.',
        );
    }

    public function testRenderWithLabelClass(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelClass('value')
                ->render(),
            'Failed asserting that element renders correctly with label class.',
        );
    }

    public function testRenderWithLabelClassNullValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->labelClass(null)
                ->render(),
            "Failed asserting that element renders correctly with label class set to 'null'.",
        );
    }

    public function testRenderWithLabelClassOverridesFalse(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value value-override" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->labelClass('value-override')
                ->render(),
            "Failed asserting that element renders correctly with label class overrides set to 'false'.",
        );
    }

    public function testRenderWithLabelClassOverridesTrue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value-override" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->labelClass('value-override', true)
                ->render(),
            "Failed asserting that element renders correctly with label class overrides set to 'true'.",
        );
    }

    public function testRenderWithLabelClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label class="value" for="inputradio">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelClass(BackedString::VALUE)
                ->render(),
            'Failed asserting that element renders correctly with label class using enum.',
        );
    }

    public function testRenderWithLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label for="value">Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelFor('value')
                ->render(),
            "Failed asserting that element renders correctly with label 'for' attribute.",
        );
    }

    public function testRenderWithLabelForNullValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            <label>Label</label>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->labelFor(null)
                ->render(),
            "Failed asserting that element renders correctly with label 'for' attribute set to 'null'.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" lang="en">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" lang="en">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" name="agree" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->name('agree')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithNotLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->label('Label')
                ->notLabel()
                ->render(),
            "Failed asserting that element renders correctly with 'notLabel()' method.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'Close')
                ->id('inputradio')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->setAttribute('data-test', 'value')
                ->id('inputradio')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addDataAttribute('value', 'test')
                ->id('inputradio')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" required>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" role="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->role('radio')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" role="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->role(Role::RADIO)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-test="value">
            HTML,
            InputRadio::tag()
                ->setAttribute('data-test', 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" title="Select radio">
            HTML,
            InputRadio::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'Select radio')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" style='width: 20px;'>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->style('width: 20px;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" tabindex="1">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" title="Select a radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->title('Select a radio')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="radio">
            HTML,
            (string) InputRadio::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" translate="no">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" translate="no">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUncheckedValue(): void
    {
        self::assertSame(
            <<<HTML
            <input name="agree" type="hidden" value="0">
            <input id="inputradio" name="agree" type="radio" value="1">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->name('agree')
                ->uncheckedValue('0')
                ->value('1')
                ->render(),
            "Failed asserting that element renders correctly with 'uncheckedValue' attribute.",
        );
    }

    public function testRenderWithUncheckedValueAndEnclosedByLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input name="agree" type="hidden" value="0">
            <label>
            <input id="inputradio" name="agree" type="radio" value="1">
            Label
            </label>
            HTML,
            InputRadio::tag()
                ->enclosedByLabel(true)
                ->id('inputradio')
                ->label('Label')
                ->name('agree')
                ->uncheckedValue('0')
                ->value('1')
                ->render(),
            "Failed asserting that element renders correctly with 'uncheckedValue' attribute and enclosed label.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputRadio::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="radio">
            HTML,
            InputRadio::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(InputRadio::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" value="accepted">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->value('accepted')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputRadio = InputRadio::tag();

        self::assertNotSame(
            $inputRadio,
            $inputRadio->checked(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->enclosedByLabel(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->label(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->labelAttributes([]),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->labelClass(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->labelFor(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->notLabel(),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputRadio,
            $inputRadio->uncheckedValue(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
