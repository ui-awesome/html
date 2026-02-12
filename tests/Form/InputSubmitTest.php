<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputSubmit;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputSubmit} submit input behavior.
 *
 * Test coverage.
 * - Applies input-submit-specific attributes (`autofocus`, `form`, `formaction`, `formenctype`, `formmethod`,
 *   `formnovalidate`, `formtarget`, `name`, `tabindex`, `value`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputSubmit} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputSubmitTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputSubmit::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" accesskey="k">
            HTML,
            InputSubmit::tag()
                ->accesskey('k')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-label="Submit form">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('label', 'Submit form')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-hidden="true">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="custom-help">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="submit">
            HTML,
            InputSubmit::tag()
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
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            <span>Suffix</span>
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputsubmit')
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
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            <span>Suffix</span>
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputsubmit')
                ->prefix('Prefix')
                ->prefixTag(Inline::SPAN)
                ->suffix('Suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true' and "
            . 'prefix/suffix.',
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-test="value">
            HTML,
            InputSubmit::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" title="Submit action">
            HTML,
            InputSubmit::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Submit action')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-submit="value">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute('submit', 'value')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-value="test">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-controls="submit-region" aria-label="Submit now">
            HTML,
            InputSubmit::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'submit-region',
                        'label' => 'Submit now',
                    ],
                )
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="submit-input" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->attributes(['class' => 'submit-input'])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" aria-describedby="inputsubmit-help">
            HTML,
            InputSubmit::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" autofocus>
            HTML,
            InputSubmit::tag()
                ->autofocus(true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="submit-input" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->class('submit-input')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" data-submit="value">
            HTML,
            InputSubmit::tag()
                ->dataAttributes(['submit' => 'value'])
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag(['class' => 'default-class'])
                ->id('inputsubmit')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit" type="submit" title="default-title">
            HTML,
            InputSubmit::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputsubmit')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()
                ->dir('ltr')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()
                ->dir(Direction::LTR)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" disabled>
            HTML,
            InputSubmit::tag()
                ->disabled(true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" form="form-id">
            HTML,
            InputSubmit::tag()
                ->form('form-id')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formaction="/submit-handler">
            HTML,
            InputSubmit::tag()
                ->formaction('/submit-handler')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formaction' attribute.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formenctype="multipart/form-data">
            HTML,
            InputSubmit::tag()
                ->formenctype('multipart/form-data')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formenctype' attribute.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formmethod="post">
            HTML,
            InputSubmit::tag()
                ->formmethod('post')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formmethod' attribute.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formnovalidate>
            HTML,
            InputSubmit::tag()
                ->formnovalidate(true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' attribute.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(false)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to 'false'.",
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->formnovalidate(null)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to 'null'.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" formtarget="_blank">
            HTML,
            InputSubmit::tag()
                ->formtarget('_blank')
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputSubmit::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputsubmit-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputSubmit::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputSubmit::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" hidden>
            HTML,
            InputSubmit::tag()
                ->hidden(true)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="submit-input" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('submit-input')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" lang="en">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" lang="en">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" name="save" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->name('save')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addAriaAttribute('label', 'Close')
                ->id('inputsubmit')
                ->removeAriaAttribute('label')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputsubmit')
                ->removeAttribute('data-test')
                ->render(),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addDataAttribute('value', 'test')
                ->id('inputsubmit')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" role="button">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->role('button')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" role="button">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->role(Role::BUTTON)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" style='width: 200px;'>
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->style('width: 200px;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" tabindex="1">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->tabIndex(1)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsubmit" type="submit">
            HTML,
            InputSubmit::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputsubmit')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" title="Submit form">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->title('Submit form')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="submit">
            HTML,
            (string) InputSubmit::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" translate="no">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" translate="no">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputSubmit::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="submit">
            HTML,
            InputSubmit::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputSubmit::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit" type="submit" value="Save">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit')
                ->value('Save')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
