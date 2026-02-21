<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate, Type};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputCheckbox;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Provider\Form\CheckedProvider;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};
use UnitEnum;

/**
 * Unit tests for the {@see InputCheckbox} class.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies input checkbox specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
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
final class InputCheckboxTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputCheckbox::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::CHECKBOX,
                'id' => null,
                'class' => 'value',
            ],
            InputCheckbox::tag()
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
            <input id="inputcheckbox" type="checkbox" accesskey="value">
            HTML,
            InputCheckbox::tag()
                ->accesskey('value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-label="value">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-hidden="true">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="value">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('describedby', 'value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="checkbox">
            HTML,
            InputCheckbox::tag()
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
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            <span>Suffix</span>
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputcheckbox')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and"
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            <span>Suffix</span>
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" onclick="alert(&apos;Clicked!&apos;)">
            HTML,
            InputCheckbox::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-controls="value" aria-label="value">
            HTML,
            InputCheckbox::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->attributes(['class' => 'value'])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" aria-describedby="inputcheckbox-help">
            HTML,
            InputCheckbox::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" autofocus>
            HTML,
            InputCheckbox::tag()
                ->autofocus(true)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" checked>
            HTML,
            InputCheckbox::tag()
                ->checked(true)
                ->id('inputcheckbox')
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
        self::assertSame(
            $expected,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->checked($checked)
                ->value($value)
                ->render(),
            "Failed asserting that element renders correctly with 'checked' and 'value' attributes.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class('value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class(BackedString::VALUE)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" data-value="value">
            HTML,
            InputCheckbox::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag(['class' => 'default-class'])
                ->id('inputcheckbox')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox" title="default-title">
            HTML,
            InputCheckbox::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputcheckbox')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir('ltr')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir(Direction::LTR)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" disabled>
            HTML,
            InputCheckbox::tag()
                ->disabled(true)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEnclosedByLabel(): void
    {
        self::assertSame(
            <<<HTML
            <label>
            <input id="inputcheckbox" type="checkbox">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox')
                ->label('Label')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and label content.',
        );
    }

    public function testRenderWithEnclosedByLabelAndCustomTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <label>
            <input id="inputcheckbox" type="checkbox">
            Label
            </label>
            </div>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox')
                ->label('Label')
                ->template('<div class="value">' . PHP_EOL . '{tag}' . PHP_EOL . '</div>')
                ->render(),
            'Failed asserting that element renders correctly with a custom template wrapper.',
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelContentEmpty(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and empty label content.',
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <label for="inputcheckbox">
            <input id="inputcheckbox" type="checkbox">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox')
                ->label('Label')
                ->labelFor('inputcheckbox')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and label "for" attribute.',
        );
    }

    public function testRenderWithEnclosedByLabelIsIdempotent(): void
    {
        $checkbox = InputCheckbox::tag()
            ->enclosedByLabel(true)
            ->id('inputcheckbox')
            ->label('Label');

        $first = $checkbox->render();
        $second = $checkbox->render();

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
            <input type="checkbox">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id(null)
                ->label('Label')
                ->render(),
            'Failed asserting that element renders correctly with enclosed label and no ID.',
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" onfocus="handleFocus()" onblur="handleBlur()">
            HTML,
            InputCheckbox::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" form="value">
            HTML,
            InputCheckbox::tag()
                ->form('value')
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputCheckbox::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputcheckbox-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputCheckbox::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" hidden>
            HTML,
            InputCheckbox::tag()
                ->hidden(true)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            <label for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->label('Label')
                ->render(),
            'Failed asserting that element renders correctly with label.',
        );
    }

    public function testRenderWithLabelAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            <label class="value" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            <label class="value" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            <label class="value" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            <label class="value value-override" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            <label class="value-override" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            <label class="value" for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->label('Label')
                ->labelClass(BackedString::VALUE)
                ->render(),
            'Failed asserting that element renders correctly with label class.',
        );
    }

    public function testRenderWithLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            <label for="inputcheckbox">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->label('Label')
                ->labelFor('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with label 'for' attribute.",
        );
    }

    public function testRenderWithLabelForNullValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            <label>Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" name="value" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->name('value')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithNotLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
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
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'value')
                ->id('inputcheckbox')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->setAttribute('class', 'value')
                ->id('inputcheckbox')
                ->removeAttribute('class')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('value', 'value')
                ->id('inputcheckbox')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->id('inputcheckbox')
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" required>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->role('checkbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->role(Role::CHECKBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" title="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" style='value'>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" tabindex="1">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputcheckbox" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputcheckbox')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" title="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="checkbox">
            HTML,
            (string) InputCheckbox::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUncheckedValue(): void
    {
        self::assertSame(
            <<<HTML
            <input name="value" type="hidden" value="0">
            <input id="inputcheckbox" name="value" type="checkbox" value="1">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->name('value')
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
            <input name="value" type="hidden" value="0">
            <label>
            <input id="inputcheckbox" name="value" type="checkbox" value="1">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox')
                ->label('Label')
                ->name('value')
                ->uncheckedValue('0')
                ->value('1')
                ->render(),
            "Failed asserting that element renders correctly with 'uncheckedValue' attribute and enclosed label.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="value" type="checkbox">
            HTML,
            InputCheckbox::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputCheckbox::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox" type="checkbox" value="value">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox')
                ->value('value')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputCheckbox = InputCheckbox::tag();

        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->checked(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->enclosedByLabel(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->label(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->labelAttributes([]),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->labelClass(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->labelFor(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->notLabel(),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->uncheckedValue(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
