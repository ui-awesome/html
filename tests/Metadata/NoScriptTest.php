<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

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
use UIAwesome\Html\Metadata\NoScript;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see NoScript} `<noscript>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, and content encoding for
 * {@see NoScript::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Renders content, default output, `begin()`/`end()`, and string casting.
 *
 * {@see NoScript} for implementation details.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('metadata')]
final class NoScriptTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $noscript = NoScript::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $noscript->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            NoScript::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            NoScript::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            <link rel="stylesheet" href="fallback.css">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->html('<link rel="stylesheet" href="fallback.css">')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <noscript accesskey="k">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-label="JavaScript required">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addAriaAttribute('label', 'JavaScript required')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-hidden="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addAriaAttribute(Aria::HIDDEN, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-test="value">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript title="Fallback content">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addAttribute(GlobalAttribute::TITLE, 'Fallback content')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-message="enable-js">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addDataAttribute('message', 'enable-js')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-value="test">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addDataAttribute(Data::VALUE, 'test')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method using enum.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-hidden="true" aria-label="No JavaScript">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()
                    ->ariaAttributes(
                        [
                            'hidden' => true,
                            'label' => 'No JavaScript',
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
            <noscript class="fallback-message">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->attributes(['class' => 'fallback-message'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <noscript autofocus>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            Please enable JavaScript
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->begin() . 'Please enable JavaScript' . NoScript::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="no-js-message">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->class('no-js-message')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            JavaScript is required for this application
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->content('JavaScript is required for this application')->render(),
            ),
            'Failed asserting that element renders correctly with content.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <noscript contenteditable="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript contenteditable="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-fallback="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->dataAttributes(['fallback' => 'true'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="default-class" title="default-title">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <noscript dir="ltr">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript dir="rtl">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->dir(Direction::RTL)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <noscript draggable="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript draggable="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(NoScript::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(NoScript::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <noscript hidden>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <noscript id="noscript-fallback">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->id('noscript-fallback')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <noscript lang="en">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->lang('en')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript lang="es">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <noscript itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()
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
            <noscript>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()
                    ->addAriaAttribute('label', 'Test')
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
            <noscript>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()
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
            <noscript>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()
                    ->addDataAttribute('test', 'value')
                    ->removeDataAttribute('test')
                    ->render(),
            ),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <noscript role="alert">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->role('alert')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript role="alert">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->role(Role::ALERT)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <noscript spellcheck="true">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <noscript style='color: red;'>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->style('color: red;')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <noscript tabindex="0">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->tabIndex(0)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="text-muted">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <noscript title="JavaScript fallback">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->title('JavaScript fallback')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                (string) NoScript::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <noscript translate="no">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript translate="no">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(NoScript::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <noscript class="from-global" id="id-user">
            </noscript>
            HTML,
            LineEndingNormalizer::normalize(
                NoScript::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(NoScript::class, []);
    }
}
