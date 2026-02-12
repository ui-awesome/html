<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Autocomplete, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputHidden;
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputHidden} hidden input behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Applies input-hidden-specific attributes (`autocomplete`, `form`, `name`, `value`) and renders expected output.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputHidden} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('form')]
final class InputHiddenTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputHidden::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" accesskey="k">
            HTML,
            InputHidden::tag()
                ->accesskey('k')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-label="Hidden input">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('label', 'Hidden input')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-hidden="true">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute(Aria::HIDDEN, true)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAriaDescribedByString(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="custom-help">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('describedby', 'custom-help')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that an explicit 'aria-describedby' string value is preserved.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueBooleanValueAndIdNull(): void
    {
        self::assertSame(
            <<<HTML
            <input type="hidden">
            HTML,
            InputHidden::tag()
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
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            <span>Suffix</span>
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('describedby', true)
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAddAriaDescribedByTrueStringValueAndPrefixSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <span>Prefix</span>
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            <span>Suffix</span>
            HTML,
            InputHidden::tag()
                ->addAriaAttribute('describedby', 'true')
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden" data-test="value">
            HTML,
            InputHidden::tag()
                ->addAttribute('data-test', 'value')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" title="Hidden input">
            HTML,
            InputHidden::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'Hidden input')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-hidden="value">
            HTML,
            InputHidden::tag()
                ->addDataAttribute('hidden', 'value')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-value="test">
            HTML,
            InputHidden::tag()
                ->addDataAttribute(Data::VALUE, 'test')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-controls="hidden-picker" aria-label="Select a hidden">
            HTML,
            InputHidden::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'hidden-picker',
                        'label' => 'Select a hidden',
                    ],
                )
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->ariaAttributes(['describedby' => true])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAriaAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->ariaAttributes(['describedby' => 'true'])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="hidden-input" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->attributes(['class' => 'hidden-input'])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueBooleanValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->attributes(['aria-describedby' => true])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAttributesAndAriaDescribedByTrueStringValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" aria-describedby="inputhidden-help">
            HTML,
            InputHidden::tag()
                ->attributes(['aria-describedby' => 'true'])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'aria-describedby' attribute set to 'true'.",
        );
    }

    public function testRenderWithAutocomplete(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" autocomplete="on">
            HTML,
            InputHidden::tag()
                ->autocomplete('on')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute.",
        );
    }

    public function testRenderWithAutocompleteUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" autocomplete="on">
            HTML,
            InputHidden::tag()
                ->autocomplete(Autocomplete::ON)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'autocomplete' attribute using enum.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="hidden-input" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->class('hidden-input')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" data-hidden="value">
            HTML,
            InputHidden::tag()
                ->dataAttributes(['hidden' => 'value'])
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag(['class' => 'default-class'])
                ->id('inputhidden')
                ->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden" title="default-title">
            HTML,
            InputHidden::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->id('inputhidden')
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" dir="ltr">
            HTML,
            InputHidden::tag()
                ->dir('ltr')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" dir="ltr">
            HTML,
            InputHidden::tag()
                ->dir(Direction::LTR)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" disabled>
            HTML,
            InputHidden::tag()
                ->disabled(true)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" form="form-id">
            HTML,
            InputHidden::tag()
                ->form('form-id')
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithGenerateId(): void
    {
        /** @phpstan-var string $id */
        $id = InputHidden::tag()->getAttribute('id', '');

        self::assertMatchesRegularExpression(
            '/^inputhidden-\w+$/',
            $id,
            'Failed asserting that element generates an ID when not provided.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            InputHidden::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            InputHidden::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" hidden>
            HTML,
            InputHidden::tag()
                ->hidden(true)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="hidden-input" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('hidden-input')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" lang="en">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" lang="en">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" name="csrf_token" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->name('csrf_token')
                ->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
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
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->addDataAttribute('value', 'test')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" role="presentation">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->role('presentation')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" role="presentation">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->role(Role::PRESENTATION)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" style='display: none;'>
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->style('display: none;')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->id('inputhidden')
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" title="Hidden input">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->title('Hidden input')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="hidden">
            HTML,
            (string) InputHidden::tag()->id(null),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" translate="no">
            HTML,
            InputHidden::tag()->id('inputhidden')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" translate="no">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            InputHidden::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <input class="from-global" id="id-user" type="hidden">
            HTML,
            InputHidden::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            InputHidden::class,
            [],
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" value="1234567890">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->value('1234567890')
                ->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
