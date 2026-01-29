<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, GlobalAttribute};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Root\Head;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Head} `<head>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, and content encoding for {@see Head::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 *
 * {@see Head} for implementation details.
 */
#[Group('html')]
#[Group('root')]
final class HeadTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $head = Head::tag()->content('<value>');

        self::assertSame('&lt;value&gt;', $head->getContent());
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Head::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Head::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            <value>
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertEquals(
            <<<HTML
            <head accesskey="k">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->accesskey('k')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head aria-pressed="true">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAriaAttribute('pressed', true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <head aria-pressed="true">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAriaAttribute(Aria::PRESSED, true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head data-test="value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAttribute('data-test', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <head title="value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head data-value="value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addDataAttribute('value', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <head data-value="value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addDataAttribute(Data::VALUE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <head aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()
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
            <head class="value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->attributes(['class' => 'value'])->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertEquals(
            <<<HTML
            <head autofocus>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->autofocus(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            Content
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->begin() . 'Content' . Head::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertEquals(
            <<<HTML
            <head class="gradient-style">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->class('gradient-style')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertEquals(
            <<<HTML
            <head contenteditable="true">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->contentEditable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <head data-value="test-value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->content('value')->dataAttributes(['value' => 'test-value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertEquals(
            <<<HTML
            <head class="default-class">
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <head class="default-class" title="default-title">
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertEquals(
            <<<HTML
            <head dir="ltr">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->dir('ltr')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertEquals(
            <<<HTML
            <head draggable="true">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->draggable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Head::class, ['class' => 'default-class']);

        self::assertEquals(
            <<<HTML
            <head class="default-class">
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Head::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertEquals(
            <<<HTML
            <head hidden>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->hidden(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertEquals(
            <<<HTML
            <head id="gradient1">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->content('value')->id('gradient1')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertEquals(
            <<<HTML
            <head lang="es">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->content('value')->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertEquals(
            <<<HTML
            <head itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()
                    ->itemId('https://example.com/item')
                    ->itemProp('name')
                    ->itemRef('info')
                    ->itemScope(true)
                    ->itemType('https://schema.org/Thing')
                    ->content('value')
                    ->render(),
            ),
            'Failed asserting that element renders correctly with microdata attributes.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAriaAttribute('label', 'Close')->removeAriaAttribute('label')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addAttribute('data-test', 'value')->removeAttribute('data-test')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addDataAttribute('value', 'test')->removeDataAttribute('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertEquals(
            <<<HTML
            <head role="banner">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->role('banner')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertEquals(
            <<<HTML
            <head spellcheck="true">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->spellcheck(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertEquals(
            <<<HTML
            <head style='test-value'>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->style('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertEquals(
            <<<HTML
            <head tabindex="3">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->content('value')->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <head class="text-muted">
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertEquals(
            <<<HTML
            <head title="test-value">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->title('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertEquals(
            <<<HTML
            <head>
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Head::tag()->content('value'),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertEquals(
            <<<HTML
            <head translate="no">
            value
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag()->translate(false)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Head::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertEquals(
            <<<HTML
            <head class="from-global" id="id-user">
            </head>
            HTML,
            LineEndingNormalizer::normalize(
                Head::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Head::class, []);
    }
}
