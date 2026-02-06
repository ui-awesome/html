<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Sectioning;

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
use UIAwesome\Html\Sectioning\Aside;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Aside} sectioning content behavior.
 *
 * Test coverage.
 * - Applies global and custom attributes, including aria-*, data-*, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('sectioning')]
final class AsideTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $aside = Aside::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $aside->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Aside::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Aside::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            <value>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <aside accesskey="k">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <aside aria-pressed="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside aria-pressed="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <aside data-test="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside title="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <aside data-value="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside data-value="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <aside aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()
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
            <aside class="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <aside autofocus>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            Content
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->begin() . 'Content' . Aside::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <aside class="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            value
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <aside contenteditable="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside contenteditable="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <aside data-value="value">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <aside class="default-class">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <aside class="default-class" title="default-title">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <aside dir="ltr">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside dir="ltr">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <aside draggable="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside draggable="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Aside::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <aside class="default-class">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Aside::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <aside hidden>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <aside id="test-id">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <aside lang="es">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside lang="es">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <aside itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()
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
            <aside>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()
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
            <aside>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()
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
            <aside>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()
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
            <aside role="complementary">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->role('complementary')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside role="complementary">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->role(Role::COMPLEMENTARY)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <aside spellcheck="true">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <aside style='value'>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <aside tabindex="3">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <aside class="text-muted">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <aside title="value">
            </aside>
            HTML,
            Aside::tag()->title('value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Aside::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <aside translate="no">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <aside translate="no">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Aside::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <aside class="from-global" id="id-user">
            </aside>
            HTML,
            LineEndingNormalizer::normalize(
                Aside::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Aside::class, []);
    }
}
