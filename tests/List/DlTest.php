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
use UIAwesome\Html\List\Dl;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Dl} rendering and global attribute behavior.
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
final class DlTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $dl = Dl::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $dl->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Dl::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Dl::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <value>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <dl accesskey="k">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dl aria-pressed="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl aria-pressed="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dl data-test="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl title="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dl data-value="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl data-value="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dl aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()
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
            <dl class="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <dl autofocus>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            Content
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->begin() . 'Content' . Dl::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <dl class="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            value
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <dl contenteditable="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl contenteditable="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dl data-value="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDd(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dd>
            First description
            </dd>
            <dd>
            Second description
            </dd>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dd('First description')->dd('Second description')->render(),
            ),
            "Failed asserting that element renders correctly with 'dd()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dl class="default-class">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dl class="default-class" title="default-title">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <dl dir="ltr">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl dir="ltr">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <dl draggable="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl draggable="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithDt(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt>
            First term
            </dt>
            <dt>
            Second term
            </dt>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dt('First term')->dt('Second term')->render(),
            ),
            "Failed asserting that element renders correctly with 'dt()' method.",
        );
    }

    public function testRenderWithDtAndDd(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            <dt>
            Term
            </dt>
            <dd>
            Description
            </dd>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->dt('Term')->dd('Description')->render(),
            ),
            "Failed asserting that element renders correctly with 'dt()' and 'dd()' methods.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Dl::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <dl class="default-class">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Dl::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <dl hidden>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <dl id="test-id">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <dl lang="es">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl lang="es">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <dl itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()
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
            <dl>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()
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
            <dl>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()
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
            <dl>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()
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
            <dl role="list">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->role('list')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl role="list">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->role(Role::LIST)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <dl spellcheck="true">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <dl style='value'>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <dl tabindex="3">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dl class="text-muted">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <dl title="value">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dl>
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Dl::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <dl translate="no">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dl translate="no">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Dl::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <dl class="from-global" id="id-user">
            </dl>
            HTML,
            LineEndingNormalizer::normalize(
                Dl::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Dl::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $dl = Dl::tag();

        self::assertNotSame(
            $dl,
            $dl->dt(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $dl,
            $dl->dd(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }
}
