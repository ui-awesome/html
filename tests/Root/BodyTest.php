<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, GlobalAttribute};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Root\Body;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Body} `<body>` behavior.
 *
 * Verifies observable behavior for {@see Body} based on this test file only (test methods and assertions).
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 *
 * {@see Body} for implementation details.
 */
#[Group('html')]
#[Group('root')]
final class BodyTest extends TestCase
{
    public function testRenderWithAccesskey(): void
    {
        self::assertEquals(
            <<<HTML
            <body accesskey="k">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->accesskey('k')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body aria-pressed="true">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAriaAttribute('pressed', true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <body aria-pressed="true">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAriaAttribute(Aria::PRESSED, true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body data-value="value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addDataAttribute('value', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <body data-value="value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addDataAttribute(Data::VALUE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body data-test="value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAttribute('data-test', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <body title="value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <body aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()
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
            <body class="value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->attributes(['class' => 'value'])->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertEquals(
            <<<HTML
            <body autofocus>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->autofocus(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            Content
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->begin() . 'Content' . Body::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertEquals(
            <<<HTML
            <body class="gradient-style">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->class('gradient-style')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testContentEncodesValues(): void
    {
        $body = Body::tag()->content('<value>');

        self::assertSame('&lt;value&gt;', $body->getContent());
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            <value>
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertEquals(
            <<<HTML
            <body contenteditable="true">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->contentEditable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <body data-value="test-value">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->content('value')->dataAttributes(['value' => 'test-value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertEquals(
            <<<HTML
            <body class="default-class">
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <body class="default-class" title="default-title">
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertEquals(
            <<<HTML
            <body dir="ltr">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->dir('ltr')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertEquals(
            <<<HTML
            <body draggable="true">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->draggable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Body::class, ['class' => 'default-class']);

        self::assertEquals(
            <<<HTML
            <body class="default-class">
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Body::class, []);
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Body::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Body::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertEquals(
            <<<HTML
            <body hidden>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->hidden(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertEquals(
            <<<HTML
            <body id="gradient1">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->content('value')->id('gradient1')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertEquals(
            <<<HTML
            <body lang="es">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->content('value')->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertEquals(
            <<<HTML
            <body itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()
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
            <body role="banner">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->role('banner')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertEquals(
            <<<HTML
            <body spellcheck="true">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->spellcheck(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertEquals(
            <<<HTML
            <body style='test-value'>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->style('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertEquals(
            <<<HTML
            <body tabindex="3">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->content('value')->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <body class="text-muted">
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Body::tag()->content('value'),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertEquals(
            <<<HTML
            <body translate="no">
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->translate(false)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAriaAttribute('label', 'Close')->removeAriaAttribute('label')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addDataAttribute('value', 'test')->removeDataAttribute('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <body>
            value
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag()->addAttribute('data-test', 'value')->removeAttribute('data-test')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Body::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertEquals(
            <<<HTML
            <body class="from-global" id="id-user">
            </body>
            HTML,
            LineEndingNormalizer::normalize(
                Body::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Body::class, []);
    }
}
