<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputCheckbox;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for the {@see InputCheckbox} class.
 *
 * Test coverage.
 *
 * - Applies input-checkbox-specific attributes (`autofocus`, `checked`, `disabled`, `form`, `name`, `required`,
 *   `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Renders label configurations, including content, attributes, and tag name.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputCheckbox} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('form')]
final class InputCheckboxTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputCheckbox::tag()
                ->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderLabelClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            <label class="value" for="inputcheckbox-">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->labelClass(BackedString::VALUE)
                ->render(),
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" accesskey="k">
            HTML,
            InputCheckbox::tag()
                ->accesskey('k')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" aria-label="Checkbox selector">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'Checkbox selector')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" aria-hidden="true">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" data-test="value">
            HTML,
            InputCheckbox::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" title="Select checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Select checkbox')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" data-checkbox="value">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('checkbox', 'value')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" data-value="test">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" aria-controls="checkbox-picker" aria-label="Select a checkbox">
            HTML,
            InputCheckbox::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'checkbox-picker',
                        'label' => 'Select a checkbox',
                    ],
                )
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="checkbox-input" id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->attributes(['class' => 'checkbox-input'])
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" autofocus>
            HTML,
            InputCheckbox::tag()
                ->autofocus(true)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" checked>
            HTML,
            InputCheckbox::tag()
                ->checked(true)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'checked' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="checkbox-input" id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class('checkbox-input')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input class="value" id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->class(BackedString::VALUE)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" data-checkbox="value">
            HTML,
            InputCheckbox::tag()
                ->dataAttributes(['checkbox' => 'value'])
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag(['class' => 'default-class'])
                ->id('inputcheckbox-')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputcheckbox-" type="checkbox" title="default-title">
            HTML,
            InputCheckbox::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputcheckbox-')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir('ltr')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" dir="ltr">
            HTML,
            InputCheckbox::tag()
                ->dir(Direction::LTR)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" disabled>
            HTML,
            InputCheckbox::tag()
                ->disabled(true)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithEnclosedByLabel(): void
    {
        self::assertSame(
            <<<HTML
            <label for="inputcheckbox-">
            <input id="inputcheckbox-" type="checkbox">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox-')
                ->label('Label')
                ->render(),
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelContentEmpty(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox-')
                ->render(),
        );
    }

    public function testRenderWithEnclosedByLabelAndLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <label for="label-for">
            <input id="inputcheckbox-" type="checkbox">
            Label
            </label>
            HTML,
            InputCheckbox::tag()
                ->enclosedByLabel(true)
                ->id('inputcheckbox-')
                ->label('Label')
                ->labelFor('label-for')
                ->render(),
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" form="form-id">
            HTML,
            InputCheckbox::tag()
                ->form('form-id')
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputCheckbox::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputCheckbox::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputCheckbox::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" hidden>
            HTML,
            InputCheckbox::tag()
                ->hidden(true)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="checkbox-input" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('checkbox-input')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            <label for="inputcheckbox-">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->render(),
        );
    }

    public function testRenderWithLabelAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            <label class="value" for="inputcheckbox-">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->render(),
        );
    }

    public function testRenderWithLabelClass(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            <label class="value" for="inputcheckbox-">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->labelClass('value')
                ->render(),
        );
    }

    public function testRenderWithLabelFor(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            <label for="value">Label</label>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->labelFor('value')
                ->render(),
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" lang="en">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" name="agree" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->name('agree')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithNotLabel(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->label('Label')
                ->notLabel()
                ->render(),
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAriaAttribute('label', 'Close')
                ->id('inputcheckbox-')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputcheckbox-')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addDataAttribute('value', 'test')
                ->id('inputcheckbox-')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" required>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->required(true)
                ->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->role('checkbox')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" role="checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->role(Role::CHECKBOX)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" style='width: 20px;'>
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->style('width: 20px;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" tabindex="1">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputcheckbox-" type="checkbox">
            HTML,
            InputCheckbox::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputcheckbox-')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" title="Select a checkbox">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->title('Select a checkbox')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertStringContainsString(
            'type="checkbox"',
            (string) InputCheckbox::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" translate="no">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputCheckbox::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputCheckbox::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputCheckbox::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputcheckbox-" type="checkbox" value="accepted">
            HTML,
            InputCheckbox::tag()
                ->id('inputcheckbox-')
                ->value('accepted')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputCheckbox = InputCheckbox::tag();

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
            $inputCheckbox->labelFor(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->labelTag(Inline::LABEL),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $inputCheckbox,
            $inputCheckbox->notLabel(),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
