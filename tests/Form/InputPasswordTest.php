<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    Autocomplete,
    Data,
    Direction,
    GlobalAttribute,
    InputMode,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputPassword;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputPassword} password input behavior.
 *
 * Test coverage.
 * - Applies input-password-specific attributes (`autocomplete`, `autofocus`, `disabled`, `form`, `inputmode`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `tabindex`, `value`)
 *   and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputPassword} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputPasswordTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputPassword::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" accesskey="k">
            HTML,
            InputPassword::tag()->id('inputpassword')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-label="Password">
            HTML,
            InputPassword::tag()->id('inputpassword')->addAriaAttribute('label', 'Password')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-hidden="true">
            HTML,
            InputPassword::tag()->id('inputpassword')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="custom-help">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputpassword')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="password">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', true)
                ->id(null)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and 'id' is 'null'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            <span>Suffix</span>
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputpassword')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and prefix/suffix.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            <span>Suffix</span>
            HTML,
            InputPassword::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputpassword')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true' and prefix/suffix.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-test="value">
            HTML,
            InputPassword::tag()->id('inputpassword')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" title="Enter password">
            HTML,
            InputPassword::tag()->id('inputpassword')->addAttribute(GlobalAttribute::TITLE, 'Enter password')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-id="value">
            HTML,
            InputPassword::tag()->id('inputpassword')->addDataAttribute('id', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-value="test">
            HTML,
            InputPassword::tag()->id('inputpassword')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-controls="password-field" aria-label="Enter password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->ariaAttributes([
                    'controls' => 'password-field',
                    'label' => 'Enter password',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="password-input" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()->id('inputpassword')->attributes(['class' => 'password-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" aria-describedby="inputpassword-help">
            HTML,
            InputPassword::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputpassword')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autocomplete="current-password">
            HTML,
            InputPassword::tag()->autocomplete('current-password')->id('inputpassword')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autocomplete="off">
            HTML,
            InputPassword::tag()->autocomplete(Autocomplete::OFF)->id('inputpassword')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" autofocus>
            HTML,
            InputPassword::tag()->autofocus(true)->id('inputpassword')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="password-input" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()->id('inputpassword')->class('password-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" data-id="value">
            HTML,
            InputPassword::tag()->id('inputpassword')->dataAttributes(['id' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password">
            HTML,
            InputPassword::tag(['class' => 'default-class'])->id('inputpassword')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password" title="default-title">
            HTML,
            InputPassword::tag()->id('inputpassword')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()->id('inputpassword')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" dir="ltr">
            HTML,
            InputPassword::tag()->id('inputpassword')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" dir="ltr">
            HTML,
            InputPassword::tag()->id('inputpassword')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" disabled>
            HTML,
            InputPassword::tag()->id('inputpassword')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" form="form-id">
            HTML,
            InputPassword::tag()->form('form-id')->id('inputpassword')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputPassword::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputpassword-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputPassword::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputPassword::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" hidden>
            HTML,
            InputPassword::tag()->id('inputpassword')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="password-input" type="password">
            HTML,
            InputPassword::tag()->id('password-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithInputMode(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" inputmode="numeric">
            HTML,
            InputPassword::tag()->id('inputpassword')->inputMode('numeric')->render(),
            "Failed asserting that element renders correctly with 'inputmode' attribute.",
        );
    }

    public function testRenderWithInputModeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" inputmode="numeric">
            HTML,
            InputPassword::tag()->id('inputpassword')->inputMode(InputMode::NUMERIC)->render(),
            "Failed asserting that element renders correctly with 'inputmode' attribute using enum.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" lang="en">
            HTML,
            InputPassword::tag()->id('inputpassword')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" lang="en">
            HTML,
            InputPassword::tag()->id('inputpassword')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" maxlength="12">
            HTML,
            InputPassword::tag()->id('inputpassword')->maxlength(12)->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" minlength="8">
            HTML,
            InputPassword::tag()->id('inputpassword')->minlength(8)->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" name="password" type="password">
            HTML,
            InputPassword::tag()->id('inputpassword')->name('password')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" pattern=".{8,}">
            HTML,
            InputPassword::tag()->id('inputpassword')->pattern('.{8,}')->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" placeholder="Password">
            HTML,
            InputPassword::tag()->id('inputpassword')->placeholder('Password')->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" readonly>
            HTML,
            InputPassword::tag()->id('inputpassword')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAriaAttribute('label', 'Close')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addAttribute('data-test', 'value')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password">
            HTML,
            InputPassword::tag()
                ->id('inputpassword')
                ->addDataAttribute('value', 'test')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" required>
            HTML,
            InputPassword::tag()->id('inputpassword')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" role="textbox">
            HTML,
            InputPassword::tag()->id('inputpassword')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" role="textbox">
            HTML,
            InputPassword::tag()->id('inputpassword')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" size="20">
            HTML,
            InputPassword::tag()->id('inputpassword')->size(20)->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" style='width: 200px;'>
            HTML,
            InputPassword::tag()->id('inputpassword')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" tabindex="1">
            HTML,
            InputPassword::tag()->id('inputpassword')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputpassword" type="password">
            HTML,
            InputPassword::tag()->id('inputpassword')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" title="Enter password">
            HTML,
            InputPassword::tag()->id('inputpassword')->title('Enter password')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="password">
            HTML,
            (string) InputPassword::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" translate="no">
            HTML,
            InputPassword::tag()->id('inputpassword')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" translate="no">
            HTML,
            InputPassword::tag()->id('inputpassword')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputPassword::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="password">
            HTML,
            InputPassword::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputPassword::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputpassword" type="password" value="secret">
            HTML,
            InputPassword::tag()->id('inputpassword')->value('secret')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
