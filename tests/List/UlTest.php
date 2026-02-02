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
use UIAwesome\Html\List\Ul;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Ul} `<ul>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, content encoding, and list item helpers for
 * {@see Ul::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, `begin()`/`end()`, and string casting.
 * - Renders list items via `li()` and `items()` helper methods.
 *
 * {@see Ul} for implementation details.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('list')]
final class UlTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $ul = Ul::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $ul->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Ul::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Ul::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <value>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <ul accesskey="k">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ul aria-pressed="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul aria-pressed="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ul data-test="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul title="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <ul data-value="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul data-value="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <ul aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()
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
            <ul class="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <ul autofocus>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            Content
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->begin() . 'Content' . Ul::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <ul class="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            value
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <ul contenteditable="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul contenteditable="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <ul data-value="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <ul class="default-class">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <ul class="default-class" title="default-title">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <ul dir="ltr">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul dir="ltr">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <ul draggable="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul draggable="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Ul::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <ul class="default-class">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Ul::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <ul hidden>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <ul id="test-id">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithItems(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li>
            Apple
            </li>
            <li>
            Banana
            </li>
            <li>
            Cherry
            </li>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->items('Apple', 'Banana', 'Cherry')->render(),
            ),
            "Failed asserting that element renders correctly with 'items()' method.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <ul lang="es">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul lang="es">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithLi(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li>
            First item
            </li>
            <li>
            Second item
            </li>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->li('First item')->li('Second item')->render(),
            ),
            "Failed asserting that element renders correctly with 'li()' method.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <ul itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()
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
            <ul>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()
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
            <ul>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()
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
            <ul>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()
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
            <ul role="list">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->role('list')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul role="list">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->role(Role::LIST)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <ul spellcheck="true">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <ul style='value'>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <ul tabindex="3">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <ul class="text-muted">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <ul title="value">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Ul::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <ul translate="no">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <ul translate="no">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Ul::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <ul class="from-global" id="id-user">
            </ul>
            HTML,
            LineEndingNormalizer::normalize(
                Ul::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Ul::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $ul = Ul::tag();

        self::assertNotSame(
            $ul,
            $ul->items(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $ul,
            $ul->li(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
