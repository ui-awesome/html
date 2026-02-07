<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, Direction, GlobalAttribute, Language, Role, Translate};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Form\InputSubmit;
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
#[Group('html')]
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
            <input id="inputsubmit-" type="submit" accesskey="k">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->accesskey('k')->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" aria-label="Submit form">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addAriaAttribute('label', 'Submit form')->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" aria-hidden="true">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addAriaAttribute(Aria::HIDDEN, true)->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" data-test="value">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addAttribute('data-test', 'value')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" title="Submit action">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addAttribute(GlobalAttribute::TITLE, 'Submit action')->render(),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" data-submit="value">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addDataAttribute('submit', 'value')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" data-value="test">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addDataAttribute(Data::VALUE, 'test')->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" aria-controls="submit-region" aria-label="Submit now">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit-')
                ->ariaAttributes([
                    'controls' => 'submit-region',
                    'label' => 'Submit now',
                ])
                ->render(),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input class="submit-input" id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->attributes(['class' => 'submit-input'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" autofocus>
            HTML,
            InputSubmit::tag()->autofocus(true)->id('inputsubmit-')->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <input class="submit-input" id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->class('submit-input')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" data-submit="value">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->dataAttributes(['submit' => 'value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag(['class' => 'default-class'])->id('inputsubmit-')->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputsubmit-" type="submit" title="default-title">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->dir('ltr')->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" dir="ltr">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" disabled>
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->disabled(true)->render(),
            "Failed asserting that element renders correctly with 'disabled' attribute.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" form="form-id">
            HTML,
            InputSubmit::tag()->form('form-id')->id('inputsubmit-')->render(),
            "Failed asserting that element renders correctly with 'form' attribute.",
        );
    }

    public function testRenderWithFormaction(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" formaction="/submit-handler">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formaction('/submit-handler')->render(),
            "Failed asserting that element renders correctly with 'formaction' attribute.",
        );
    }

    public function testRenderWithFormenctype(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" formenctype="multipart/form-data">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formenctype('multipart/form-data')->render(),
            "Failed asserting that element renders correctly with 'formenctype' attribute.",
        );
    }

    public function testRenderWithFormmethod(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" formmethod="post">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formmethod('post')->render(),
            "Failed asserting that element renders correctly with 'formmethod' attribute.",
        );
    }

    public function testRenderWithFormnovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" formnovalidate>
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formnovalidate(true)->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' attribute.",
        );
    }

    public function testRenderWithFormnovalidateValueFalse(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formnovalidate(false)->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to false.",
        );
    }

    public function testRenderWithFormnovalidateValueNull(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formnovalidate(null)->render(),
            "Failed asserting that element renders correctly with 'formnovalidate' set to null.",
        );
    }

    public function testRenderWithFormtarget(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" formtarget="_blank">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->formtarget('_blank')->render(),
            "Failed asserting that element renders correctly with 'formtarget' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(InputSubmit::class, ['class' => 'default-class']);

        self::assertStringContainsString(
            'class="default-class"',
            InputSubmit::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(InputSubmit::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" hidden>
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <input id="submit-input" type="submit">
            HTML,
            InputSubmit::tag()->id('submit-input')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" lang="en">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->lang('en')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" lang="en">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->lang(Language::ENGLISH)->render(),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" name="save" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->name('save')->render(),
            "Failed asserting that element renders correctly with 'name' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit-')
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
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit-')
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
            <input id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()
                ->id('inputsubmit-')
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
            <input id="inputsubmit-" type="submit" role="button">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->role('button')->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" role="button">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->role(Role::BUTTON)->render(),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" style='width: 200px;'>
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->style('width: 200px;')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" tabindex="1">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->tabIndex(1)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <input class="text-muted" id="inputsubmit-" type="submit">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" title="Submit form">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->title('Submit form')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertStringContainsString(
            'type="submit"',
            LineEndingNormalizer::normalize((string) InputSubmit::tag()),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" translate="no">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->translate(false)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" translate="no">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->translate(Translate::NO)->render(),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(InputSubmit::class, ['class' => 'from-global', 'id' => 'id-global']);

        $output = InputSubmit::tag(['id' => 'id-user'])->render();

        self::assertStringContainsString('class="from-global"', $output);
        self::assertStringContainsString('id="id-user"', $output);

        SimpleFactory::setDefaults(InputSubmit::class, []);
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputsubmit-" type="submit" value="Save">
            HTML,
            InputSubmit::tag()->id('inputsubmit-')->value('Save')->render(),
            "Failed asserting that element renders correctly with 'value' attribute.",
        );
    }
}
