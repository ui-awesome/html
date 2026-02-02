<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPForge\Support\LineEndingNormalizer;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{
    Aria,
    ContentEditable,
    Data,
    Direction,
    Draggable,
    GlobalAttribute,
    Language,
    Role,
    Translate,
};
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Root\Header;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Header} `<header>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, and content encoding for
 * {@see Header::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 *
 * {@see Header} for implementation details.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('root')]
final class HeaderTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $header = Header::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $header->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Header::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Header::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            <value>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <header accesskey="k">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header aria-pressed="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header aria-pressed="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header data-test="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header title="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header data-value="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header data-value="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <header aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()
                    ->ariaAttributes(
                        [
                            'controls' => static fn(): string => 'modal-1',
                            'hidden' => false,
                            'label' => 'Close',
                        ],
                    )
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <header class="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <header autofocus>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            Content
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->begin() . 'Content' . Header::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <header class="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            value
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <header contenteditable="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header contenteditable="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <header data-value="value">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <header class="default-class">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <header class="default-class" title="default-title">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <header dir="ltr">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header dir="ltr">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <header draggable="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header draggable="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Header::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <header class="default-class">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Header::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <header hidden>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <header id="test-id">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <header lang="es">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header lang="es">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <header itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()
                    ->itemId('https://example.com/item')
                    ->itemProp('name')
                    ->itemRef('info')
                    ->itemScope(true)
                    ->itemType('https://schema.org/Thing')
                    ->render(),
            ),
            'Failed asserting that element renders correctly with microdata attributes.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()
                    ->addAriaAttribute('label', 'Close')
                    ->removeAriaAttribute('label')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()
                    ->addAttribute('data-test', 'value')
                    ->removeAttribute('data-test')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeAttribute()' method.",
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()
                    ->addDataAttribute('value', 'test')
                    ->removeDataAttribute('value')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <header role="banner">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->role('banner')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header role="banner">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->role(Role::BANNER)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <header spellcheck="true">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <header style='value'>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <header tabindex="3">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <header class="text-muted">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <header title="value">
            </header>
            HTML,
            Header::tag()->title('value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Header::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <header translate="no">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <header translate="no">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Header::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <header class="from-global" id="id-user">
            </header>
            HTML,
            LineEndingNormalizer::normalize(
                Header::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Header::class, []);
    }
}
