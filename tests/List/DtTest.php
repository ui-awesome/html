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
use UIAwesome\Html\List\Dt;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Dt} `<dt>` behavior.
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
#[Group('list')]
final class DtTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $dt = Dt::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $dt->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Dt::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Dt::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            <value>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <dt accesskey="k">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dt aria-pressed="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt aria-pressed="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dt data-test="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt title="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dt data-value="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt data-value="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dt aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()
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
            <dt class="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <dt autofocus>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            Content
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->begin() . 'Content' . Dt::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <dt class="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            value
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <dt contenteditable="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt contenteditable="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dt data-value="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dt class="default-class">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dt class="default-class" title="default-title">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <dt dir="ltr">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt dir="ltr">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <dt draggable="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt draggable="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Dt::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <dt class="default-class">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Dt::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <dt hidden>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <dt id="test-id">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <dt lang="es">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt lang="es">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <dt itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()
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
            <dt>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()
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
            <dt>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()
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
            <dt>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()
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
            <dt role="listitem">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->role('listitem')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt role="listitem">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->role(Role::LISTITEM)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <dt spellcheck="true">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <dt style='value'>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <dt tabindex="3">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dt class="text-muted">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <dt title="value">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Dt::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <dt translate="no">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dt translate="no">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Dt::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <dt class="from-global" id="id-user">
            </dt>
            HTML,
            LineEndingNormalizer::normalize(
                Dt::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Dt::class, []);
    }
}
