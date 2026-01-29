<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Aria, Data, GlobalAttribute};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Root\Html;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Html} `<html>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, and content encoding for {@see Html::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 *
 * {@see Html} for implementation details.
 */
#[Group('html')]
#[Group('root')]
final class HtmlTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $html = Html::tag()->content('<value>');

        self::assertSame('&lt;value&gt;', $html->getContent());
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Html::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Html::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            <value>
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertEquals(
            <<<HTML
            <html accesskey="k">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->accesskey('k')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <html aria-pressed="true">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAriaAttribute('pressed', true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <html aria-pressed="true">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAriaAttribute(Aria::PRESSED, true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <html data-test="value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAttribute('data-test', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <html title="value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <html data-value="value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addDataAttribute('value', 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertEquals(
            <<<HTML
            <html data-value="value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addDataAttribute(Data::VALUE, 'value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <html aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()
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
            <html class="value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->attributes(['class' => 'value'])->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertEquals(
            <<<HTML
            <html autofocus>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->autofocus(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            Content
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->begin() . 'Content' . Html::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertEquals(
            <<<HTML
            <html class="gradient-style">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->class('gradient-style')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertEquals(
            <<<HTML
            <html contenteditable="true">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->contentEditable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertEquals(
            <<<HTML
            <html data-value="test-value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->content('value')->dataAttributes(['value' => 'test-value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertEquals(
            <<<HTML
            <html class="default-class">
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <html class="default-class" title="default-title">
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertEquals(
            <<<HTML
            <html dir="ltr">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->dir('ltr')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertEquals(
            <<<HTML
            <html draggable="true">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->draggable(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Html::class, ['class' => 'default-class']);

        self::assertEquals(
            <<<HTML
            <html class="default-class">
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Html::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertEquals(
            <<<HTML
            <html hidden>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->hidden(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertEquals(
            <<<HTML
            <html id="gradient1">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->content('value')->id('gradient1')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertEquals(
            <<<HTML
            <html lang="es">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->content('value')->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertEquals(
            <<<HTML
            <html itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()
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
            <html>
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAriaAttribute('label', 'Close')->removeAriaAttribute('label')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addAttribute('data-test', 'value')->removeAttribute('data-test')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addDataAttribute('value', 'test')->removeDataAttribute('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertEquals(
            <<<HTML
            <html role="banner">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->role('banner')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertEquals(
            <<<HTML
            <html spellcheck="true">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->spellcheck(true)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertEquals(
            <<<HTML
            <html style='test-value'>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->style('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertEquals(
            <<<HTML
            <html tabindex="3">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->content('value')->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertEquals(
            <<<HTML
            <html class="tag-default">
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->addThemeProvider('default', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertEquals(
            <<<HTML
            <html title="test-value">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->title('test-value')->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertEquals(
            <<<HTML
            <html>
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Html::tag()->content('value'),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertEquals(
            <<<HTML
            <html translate="no">
            value
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag()->translate(false)->content('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Html::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertEquals(
            <<<HTML
            <html class="from-global" id="id-user">
            </html>
            HTML,
            LineEndingNormalizer::normalize(
                Html::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Html::class, []);
    }
}
