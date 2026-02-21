<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate, Type};
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
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input radio specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
 *   `tabindex`, `value`) and renders expected output.
 * - Handles edge cases for `checked` attribute with various data types and value comparisons.
 * - Renders attributes and string casting for a void element.
 * - Renders label configurations, including content, attributes, and tag name.
 * - Resolves default and theme providers, including global defaults and user overrides.
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
            'value',
            InputRadio::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'id' => null,
                'type' => Type::RADIO,
                'class' => 'value',
            ],
            InputRadio::tag()
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
            <input id="inputradio" type="radio" accesskey="value">
            HTML,
            InputRadio::tag()
                ->accesskey('value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-label="value">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-label="value">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-describedby="value">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('describedby', 'value')
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
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputRadio::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" aria-controls="value" aria-label="value">
            HTML,
            InputRadio::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
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
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->attributes(['class' => 'value'])
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
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->class('value')
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
            <input id="inputradio" type="radio" data-value="value">
            HTML,
            InputRadio::tag()
                ->dataAttributes(['value' => 'value'])
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputRadio::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" form="value">
            HTML,
            InputRadio::tag()
                ->form('value')
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
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" name="value" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addAriaAttribute('label', 'value')
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
                ->setAttribute('class', 'value')
                ->id('inputradio')
                ->removeAttribute('class')
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
                ->addDataAttribute('value', 'value')
                ->id('inputradio')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputradio')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" title="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" style='value'>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->style('value')
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
            <input id="inputradio" type="radio" title="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->title('value')
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            <input class="from-global" id="value" type="radio">
            HTML,
            InputRadio::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(InputRadio::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" value="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->value('value')
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
    }
}
