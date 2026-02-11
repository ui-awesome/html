<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputText;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputText} text input behavior.
 *
 * Test coverage.
 * - Applies input-text-specific attributes (`autocomplete`, `autofocus`, `dirname`, `disabled`, `form`, `list`,
 *   `maxlength`, `minlength`, `name`, `pattern`, `placeholder`, `readonly`, `required`, `size`, `spellcheck`,
 *   `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputText} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputTextTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputText::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" accesskey="k">
            HTML,
            InputText::tag()->id('inputtext')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-label="Text input">
            HTML,
            InputText::tag()->id('inputtext')->addAriaAttribute('label', 'Text input')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-hidden="true">
            HTML,
            InputText::tag()->id('inputtext')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="custom-help">
            HTML,
            InputText::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputtext')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtext')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to "
            . "'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="text">
            HTML,
            InputText::tag()
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
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            <span>Suffix</span>
            HTML,
            InputText::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputtext')
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
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtext')
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
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            <span>Suffix</span>
            HTML,
            InputText::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputtext')
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
            <input id="inputtext" type="text" data-test="value">
            HTML,
            InputText::tag()->id('inputtext')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" title="Enter text">
            HTML,
            InputText::tag()->id('inputtext')->addAttribute(GlobalAttribute::TITLE, 'Enter text')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-text="value">
            HTML,
            InputText::tag()->id('inputtext')->addDataAttribute('text', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-value="test">
            HTML,
            InputText::tag()->id('inputtext')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-controls="text-picker" aria-label="Enter text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->ariaAttributes([
                    'controls' => 'text-picker',
                    'label' => 'Enter text',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputtext')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputtext')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-input" id="inputtext" type="text">
            HTML,
            InputText::tag()->id('inputtext')->attributes(['class' => 'text-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputtext')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" aria-describedby="inputtext-help">
            HTML,
            InputText::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputtext')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to true.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autocomplete="on">
            HTML,
            InputText::tag()->autocomplete('on')->id('inputtext')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autocomplete="on">
            HTML,
            InputText::tag()->autocomplete(Autocomplete::ON)->id('inputtext')->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autofocus>
            HTML,
            InputText::tag()->autofocus(true)->id('inputtext')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-input" id="inputtext" type="text">
            HTML,
            InputText::tag()->id('inputtext')->class('text-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" data-text="value">
            HTML,
            InputText::tag()->id('inputtext')->dataAttributes(['text' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text">
            HTML,
            InputText::tag(['class' => 'default-class'])->id('inputtext')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text" title="default-title">
            HTML,
            InputText::tag()->id('inputtext')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()->id('inputtext')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dir="ltr">
            HTML,
            InputText::tag()->id('inputtext')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dirname="comment.dir">
            HTML,
            InputText::tag()->dirname('comment.dir')->id('inputtext')->render(),
            "Failed asserting that element renders correctly with 'dirname' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dir="ltr">
            HTML,
            InputText::tag()->id('inputtext')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" disabled>
            HTML,
            InputText::tag()->id('inputtext')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" form="form-id">
            HTML,
            InputText::tag()->form('form-id')->id('inputtext')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputText::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputtext-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputText::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputText::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputText::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" hidden>
            HTML,
            InputText::tag()->id('inputtext')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="text-input" type="text">
            HTML,
            InputText::tag()->id('text-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" lang="en">
            HTML,
            InputText::tag()->id('inputtext')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" lang="en">
            HTML,
            InputText::tag()->id('inputtext')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" list="texts">
            HTML,
            InputText::tag()->id('inputtext')->list('texts')->render(),
            "Failed asserting that element renders correctly with 'list' attribute.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" maxlength="10">
            HTML,
            InputText::tag()->id('inputtext')->maxlength(10)->render(),
            "Failed asserting that element renders correctly with 'maxlength' attribute.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" minlength="5">
            HTML,
            InputText::tag()->id('inputtext')->minlength(5)->render(),
            "Failed asserting that element renders correctly with 'minlength' attribute.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" name="username" type="text">
            HTML,
            InputText::tag()->id('inputtext')->name('username')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" pattern='[A-Za-z]{3}'>
            HTML,
            InputText::tag()->id('inputtext')->pattern('[A-Za-z]{3}')->render(),
            "Failed asserting that element renders correctly with 'pattern' attribute.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" placeholder="Enter text">
            HTML,
            InputText::tag()->id('inputtext')->placeholder('Enter text')->render(),
            "Failed asserting that element renders correctly with 'placeholder' attribute.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" readonly>
            HTML,
            InputText::tag()->id('inputtext')->readonly(true)->render(),
            "Failed asserting that element renders correctly with 'readonly' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
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
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
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
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
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
            <input id="inputtext" type="text" required>
            HTML,
            InputText::tag()->id('inputtext')->required(true)->render(),
            "Failed asserting that element renders correctly with 'required' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" role="textbox">
            HTML,
            InputText::tag()->id('inputtext')->role('textbox')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" role="textbox">
            HTML,
            InputText::tag()->id('inputtext')->role(Role::TEXTBOX)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSize(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" size="20">
            HTML,
            InputText::tag()->id('inputtext')->size(20)->render(),
            "Failed asserting that element renders correctly with 'size' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" spellcheck="true">
            HTML,
            InputText::tag()->id('inputtext')->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" style='width: 200px;'>
            HTML,
            InputText::tag()->id('inputtext')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" tabindex="1">
            HTML,
            InputText::tag()->id('inputtext')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputtext" type="text">
            HTML,
            InputText::tag()->id('inputtext')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" title="Enter text">
            HTML,
            InputText::tag()->id('inputtext')->title('Enter text')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="text">
            HTML,
            InputText::tag()
                ->id(null)
                ->render(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" translate="no">
            HTML,
            InputText::tag()->id('inputtext')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" translate="no">
            HTML,
            InputText::tag()->id('inputtext')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputText::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputText::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputText::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" value="test">
            HTML,
            InputText::tag()->id('inputtext')->value('test')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
