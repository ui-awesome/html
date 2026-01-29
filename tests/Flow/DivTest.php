<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Flow;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, GlobalAttribute};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Flow\Div;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Div} `<div>` behavior.
 *
 * Verifies observable behavior for {@see Div} based on this test file only (test methods and assertions).
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 *
 * {@see Div} for implementation details.
 */
#[Group('html')]
#[Group('flow')]
final class DivTest extends TestCase
{
    public function testRenderWithAccesskey(): void
    {
        self::assertEquals(
            <<<HTML
            <div accesskey="k">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->accesskey('k')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div aria-pressed="true">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAriaAttribute('pressed', true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <div aria-pressed="true">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAriaAttribute(Aria::PRESSED, true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div data-value="value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addDataAttribute('value', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <div data-value="value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addDataAttribute(Data::VALUE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div data-test="value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAttribute('data-test', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <div title="value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <div aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()
                    ->ariaAttributes(
                        [
                            'controls' => static fn(): string => 'modal-1',
                            'hidden' => false,
                            'label' => 'Close',
                        ],
                    )
                    ->content('value')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <div class="value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->attributes(['class' => 'value'])->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertEquals(
            <<<HTML
            <div autofocus>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->autofocus(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            Content
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->begin() . 'Content' . Div::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertEquals(
            <<<HTML
            <div class="gradient-style">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->class('gradient-style')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testContentEncodesValues(): void
    {
        $div = Div::tag()->content('<value>');

        self::assertSame('&lt;value&gt;', $div->getContent());
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            <value>
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertEquals(
            <<<HTML
            <div contenteditable="true">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->contentEditable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <div data-value="test-value">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->content('value')->dataAttributes(['value' => 'test-value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertEquals(
            <<<HTML
            <div class="default-class">
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <div class="default-class" title="default-title">
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertEquals(
            <<<HTML
            <div dir="ltr">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->dir('ltr')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertEquals(
            <<<HTML
            <div draggable="true">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->draggable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class' => 'default-class']);

        self::assertEquals(
            <<<HTML
            <div class="default-class">
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Div::class, []);
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Div::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Div::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertEquals(
            <<<HTML
            <div hidden>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->hidden(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertEquals(
            <<<HTML
            <div id="gradient1">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->content('value')->id('gradient1')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertEquals(
            <<<HTML
            <div lang="es">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->content('value')->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertEquals(
            <<<HTML
            <div itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()
                    ->itemId('https://example.com/item')
                    ->itemProp('name')
                    ->itemRef('info')
                    ->itemScope(true)
                    ->itemType('https://schema.org/Thing')
                    ->content('value')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with microdata attributes.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertEquals(
            <<<HTML
            <div role="banner">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->role('banner')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertEquals(
            <<<HTML
            <div spellcheck="true">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->spellcheck(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertEquals(
            <<<HTML
            <div style='test-value'>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->style('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertEquals(
            <<<HTML
            <div tabindex="3">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->content('value')->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <div class="text-muted">
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Div::tag()->content('value'),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertEquals(
            <<<HTML
            <div translate="no">
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->translate(false)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAriaAttribute('label', 'Close')->removeAriaAttribute('label')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addDataAttribute('value', 'test')->removeDataAttribute('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <div>
            value
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag()->addAttribute('data-test', 'value')->removeAttribute('data-test')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertEquals(
            <<<HTML
            <div class="from-global" id="id-user">
            </div>
            HTML,
            LineEndingNormalizer::normalize(
                Div::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Div::class, []);
    }
}
