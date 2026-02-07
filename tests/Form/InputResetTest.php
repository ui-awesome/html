<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputReset;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see InputReset} reset input behavior.
 *
 * Test coverage.
 * - Applies input-reset-specific attributes (`autofocus`, `disabled`, `name`, `tabindex`, `value`) and renders expected
 *   output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Renders attributes and string casting for a void element.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * {@see InputReset} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('form')]
final class InputResetTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            InputReset::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" accesskey="k">
            HTML,
            InputReset::tag()->id('inputreset-')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" aria-label="Reset form">
            HTML,
            InputReset::tag()->id('inputreset-')->addAriaAttribute('label', 'Reset form')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" aria-hidden="true">
            HTML,
            InputReset::tag()->id('inputreset-')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" data-test="value">
            HTML,
            InputReset::tag()->id('inputreset-')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" title="Reset form">
            HTML,
            InputReset::tag()->id('inputreset-')->addAttribute(GlobalAttribute::TITLE, 'Reset form')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" data-reset="value">
            HTML,
            InputReset::tag()->id('inputreset-')->addDataAttribute('reset', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" data-value="test">
            HTML,
            InputReset::tag()->id('inputreset-')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" aria-controls="form-id" aria-label="Reset form">
            HTML,
            InputReset::tag()
                ->id('inputreset-')
                ->ariaAttributes([
                    'controls' => 'form-id',
                    'label' => 'Reset form',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="reset-input" id="inputreset-" type="reset">
            HTML,
            InputReset::tag()->id('inputreset-')->attributes(['class' => 'reset-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" autofocus>
            HTML,
            InputReset::tag()->autofocus(true)->id('inputreset-')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="reset-input" id="inputreset-" type="reset">
            HTML,
            InputReset::tag()->id('inputreset-')->class('reset-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" data-reset="value">
            HTML,
            InputReset::tag()->id('inputreset-')->dataAttributes(['reset' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputreset-" type="reset">
            HTML,
            InputReset::tag(['class' => 'default-class'])->id('inputreset-')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputreset-" type="reset" title="default-title">
            HTML,
            InputReset::tag()->id('inputreset-')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        $output = InputReset::tag()->render();

        self::assertStringContainsString('type="reset"', $output);
        self::assertStringContainsString('<input', $output);
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" dir="ltr">
            HTML,
            InputReset::tag()->id('inputreset-')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" dir="ltr">
            HTML,
            InputReset::tag()->id('inputreset-')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" disabled>
            HTML,
            InputReset::tag()->id('inputreset-')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputReset::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputReset::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputReset::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" hidden>
            HTML,
            InputReset::tag()->id('inputreset-')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="reset-input" type="reset">
            HTML,
            InputReset::tag()->id('reset-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" lang="en">
            HTML,
            InputReset::tag()->id('inputreset-')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" lang="en">
            HTML,
            InputReset::tag()->id('inputreset-')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" name="reset-form" type="reset">
            HTML,
            InputReset::tag()->id('inputreset-')->name('reset-form')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset">
            HTML,
            InputReset::tag()
                ->id('inputreset-')
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
            <input id="inputreset-" type="reset">
            HTML,
            InputReset::tag()
                ->id('inputreset-')
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
            <input id="inputreset-" type="reset">
            HTML,
            InputReset::tag()
                ->id('inputreset-')
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
            <input id="inputreset-" type="reset" role="button">
            HTML,
            InputReset::tag()->id('inputreset-')->role('button')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" role="button">
            HTML,
            InputReset::tag()->id('inputreset-')->role(Role::BUTTON)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" style='width: 200px;'>
            HTML,
            InputReset::tag()->id('inputreset-')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" tabindex="1">
            HTML,
            InputReset::tag()->id('inputreset-')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputreset-" type="reset">
            HTML,
            InputReset::tag()->id('inputreset-')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" title="Reset form">
            HTML,
            InputReset::tag()->id('inputreset-')->title('Reset form')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertStringContainsString(
            'type="reset"',
            LineEndingNormalizer::normalize((string) InputReset::tag()),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" translate="no">
            HTML,
            InputReset::tag()->id('inputreset-')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" translate="no">
            HTML,
            InputReset::tag()->id('inputreset-')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputReset::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputReset::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputReset::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset-" type="reset" value="Reset">
            HTML,
            InputReset::tag()->id('inputreset-')->value('Reset')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
