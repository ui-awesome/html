<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

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
use UIAwesome\Html\List\Ol;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Ol} rendering and global attribute behavior.
 *
 * Test coverage.
 * - Applies `ol`-specific attributes (`reversed`, `start`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('list')]
final class OlTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $ol = Ol::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $ol->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Ol::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Ol::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <value>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <ol accesskey="k">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ol aria-pressed="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol aria-pressed="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ol data-test="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol title="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ol data-value="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol data-value="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <ol aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()
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
            <ol class="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <ol autofocus>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            Content
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->begin() . 'Content' . Ol::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <ol class="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            value
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <ol contenteditable="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol contenteditable="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <ol data-value="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <ol class="default-class">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <ol class="default-class" title="default-title">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <ol dir="ltr">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol dir="ltr">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <ol draggable="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol draggable="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Ol::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <ol class="default-class">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Ol::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <ol hidden>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <ol id="test-id">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithItems(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li>
            Apple
            </li>
            <li>
            Banana
            </li>
            <li>
            Cherry
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->items('Apple', 'Banana', 'Cherry')->render(),
            ),
            "Failed asserting that element renders correctly with 'items()' method.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <ol lang="es">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol lang="es">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithLi(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li>
            First item
            </li>
            <li>
            Second item
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->li('First item')->li('Second item')->render(),
            ),
            "Failed asserting that element renders correctly with 'li()' method.",
        );
    }

    public function testRenderWithLiValue(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li value="3">
            Item
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->li('Item', 3)->render(),
            ),
            "Failed asserting that element renders correctly with 'li()' method using a value.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <ol itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()
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
            <ol>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()
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
            <ol>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()
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
            <ol>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()
                    ->addDataAttribute('value', 'test')
                    ->removeDataAttribute('value')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithReversed(): void
    {
        self::assertSame(
            <<<HTML
            <ol reversed>
            <li>
            Item
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->reversed(true)->li('Item')->render(),
            ),
            "Failed asserting that element renders correctly with 'reversed' attribute.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <ol role="list">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->role('list')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol role="list">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->role(Role::LIST)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <ol spellcheck="true">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStart(): void
    {
        self::assertSame(
            <<<HTML
            <ol start="5">
            <li>
            Item
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->start(5)->li('Item')->render(),
            ),
            "Failed asserting that element renders correctly with 'start' attribute.",
        );
    }

    public function testRenderWithStartAndReversed(): void
    {
        self::assertSame(
            <<<HTML
            <ol start="10" reversed>
            <li>
            First
            </li>
            <li>
            Second
            </li>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->start(10)->reversed(true)->li('First')->li('Second')->render(),
            ),
            "Failed asserting that element renders correctly with both 'start' and 'reversed' attributes.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <ol style='value'>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <ol tabindex="3">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <ol class="text-muted">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <ol title="value">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Ol::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <ol translate="no">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ol translate="no">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Ol::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <ol class="from-global" id="id-user">
            </ol>
            HTML,
            LineEndingNormalizer::normalize(
                Ol::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Ol::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $ol = Ol::tag();

        self::assertNotSame(
            $ol,
            $ol->items(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $ol,
            $ol->li(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
