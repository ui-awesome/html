<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

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
use UIAwesome\Html\Heading\H6;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see H6} rendering and global attribute behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('heading')]
final class H6Test extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $h6 = H6::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $h6->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            H6::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            H6::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            <value>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <h6 accesskey="k">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <h6 aria-pressed="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 aria-pressed="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <h6 data-test="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 title="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <h6 data-value="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 data-value="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <h6 aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()
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
            <h6 class="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <h6 autofocus>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            Content
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->begin() . 'Content' . H6::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <h6 class="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            value
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <h6 contenteditable="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 contenteditable="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <h6 data-value="value">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h6 class="default-class">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <h6 class="default-class" title="default-title">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <h6 dir="ltr">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 dir="ltr">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <h6 draggable="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 draggable="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(H6::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <h6 class="default-class">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(H6::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <h6 hidden>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <h6 id="test-id">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <h6 lang="es">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 lang="es">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <h6 itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()
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
            <h6>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()
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
            <h6>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()
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
            <h6>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()
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
            <h6 role="banner">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->role('banner')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 role="banner">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->role(Role::BANNER)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <h6 spellcheck="true">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <h6 style='value'>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <h6 tabindex="3">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <h6 class="text-muted">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <h6 title="value">
            </h6>
            HTML,
            H6::tag()->title('value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                (string) H6::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <h6 translate="no">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <h6 translate="no">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(H6::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <h6 class="from-global" id="id-user">
            </h6>
            HTML,
            LineEndingNormalizer::normalize(
                H6::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(H6::class, []);
    }
}
