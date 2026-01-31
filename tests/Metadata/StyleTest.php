<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
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
use UIAwesome\Html\Attribute\Values\Blocking;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Style;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Style} `<style>` behavior.
 *
 * Verifies rendered output, attribute handling, configuration precedence, and content encoding for {@see Style::tag()}.
 *
 * Test coverage.
 * - Applies global `aria-*` and `data-*` attributes via helper methods.
 * - Applies global defaults and theme providers via {@see SimpleFactory} and provider stubs.
 * - Applies style attributes via dedicated helper methods.
 * - Renders content, default output, `begin()`/`end()`, and string casting.
 *
 * {@see Style} for implementation details.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('metadata')]
final class StyleTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $style = Style::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $style->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Style::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Style::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            <value>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <style accesskey="k">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <style aria-pressed="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style aria-pressed="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <style data-test="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style title="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <style data-value="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style data-value="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <style aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()
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
            <style class="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <style autofocus>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            Content
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->begin() . 'Content' . Style::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithBlocking(): void
    {
        self::assertSame(
            <<<HTML
            <style blocking="render">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->blocking('render')->render(),
            ),
            "Failed asserting that element renders correctly with 'blocking' attribute.",
        );
    }

    public function testRenderWithBlockingUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style blocking="render">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->blocking(Blocking::RENDER)->render(),
            ),
            "Failed asserting that element renders correctly with 'blocking' attribute using enum.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <style class="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            value
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <style contenteditable="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style contenteditable="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <style data-value="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <style class="default-class">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <style class="default-class" title="default-title">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <style dir="ltr">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style dir="ltr">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <style draggable="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style draggable="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Style::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <style class="default-class">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Style::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <style hidden>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <style id="test-id">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <style lang="es">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style lang="es">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <style media="screen">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->media('screen')->render(),
            ),
            "Failed asserting that element renders correctly with 'media' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <style itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()
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

    public function testRenderWithNonce(): void
    {
        self::assertSame(
            <<<HTML
            <style nonce="nonce-value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->nonce('nonce-value')->render(),
            ),
            "Failed asserting that element renders correctly with 'nonce' attribute.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()
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
            <style>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()
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
            <style>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()
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
            <style role="banner">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->role('banner')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style role="banner">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->role(Role::BANNER)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <style spellcheck="true">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <style style='value'>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <style tabindex="3">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <style class="text-muted">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <style title="value">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Style::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <style translate="no">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <style translate="no">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithType(): void
    {
        self::assertSame(
            <<<HTML
            <style type="text/css">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag()->type('text/css')->render(),
            ),
            "Failed asserting that element renders correctly with 'type' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Style::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <style class="from-global" id="id-user">
            </style>
            HTML,
            LineEndingNormalizer::normalize(
                Style::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Style::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $style = Style::tag();

        self::assertNotSame(
            $style,
            $style->blocking(Blocking::RENDER),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $style,
            $style->media('screen'),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $style,
            $style->nonce('nonce-value'),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $style,
            $style->type('text/css'),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionForSettingBlocking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'blocking',
                implode("', '", Enum::normalizeArray(Blocking::cases())),
            ),
        );

        Style::tag()->blocking('invalid-value');
    }
}
