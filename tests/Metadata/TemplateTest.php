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
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Template;
use UIAwesome\Html\Metadata\Values\ShadowRootMode;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Template} rendering and template attribute behavior.
 *
 * Test coverage.
 * - Applies `template`-specific attributes (`shadowrootclonable`, `shadowrootdelegatesfocus`, `shadowrootmode`,
 *   `shadowrootreferencetarget`, `shadowrootserializable`) and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*`, and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('metadata')]
final class TemplateTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        $template = Template::tag()->content('<value>');

        self::assertSame(
            '&lt;value&gt;',
            $template->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'default',
            Template::tag()->getAttribute('data-test', 'default'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['data-test' => 'value'],
            Template::tag()->addAttribute('data-test', 'value')->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            <value>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->html('<value>')->render(),
            ),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <template accesskey="k">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->accesskey('k')->render(),
            ),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-pressed="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addAriaAttribute('pressed', true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-pressed="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addAriaAttribute(Aria::PRESSED, true)->render(),
            ),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template data-test="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addAttribute('data-test', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method.",
        );
    }

    public function testRenderWithAddAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template title="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addAttribute(GlobalAttribute::TITLE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addAttribute()' method using enum.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template data-value="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addDataAttribute('value', 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template data-value="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addDataAttribute(Data::VALUE, 'value')->render(),
            ),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-controls="modal-1" aria-hidden="false" aria-label="Close">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()
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
            <template class="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->attributes(['class' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <template autofocus>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->autofocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            Content
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->begin() . 'Content' . Template::end(),
            ),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <template class="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->class('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            value
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->content('value')->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <template contenteditable="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->contentEditable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template contenteditable="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->contentEditable(ContentEditable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'contentEditable' attribute using enum.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <template data-value="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->dataAttributes(['value' => 'value'])->render(),
            ),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <template class="default-class">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag(['class' => 'default-class'])->render(),
            ),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <template class="default-class" title="default-title">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            ),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->render(),
            ),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <template dir="ltr">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->dir('ltr')->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template dir="ltr">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->dir(Direction::LTR)->render(),
            ),
            "Failed asserting that element renders correctly with 'dir' attribute using enum.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <template draggable="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->draggable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template draggable="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->draggable(Draggable::TRUE)->render(),
            ),
            "Failed asserting that element renders correctly with 'draggable' attribute using enum.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Template::class, ['class' => 'default-class']);

        self::assertSame(
            <<<HTML
            <template class="default-class">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->render(),
            ),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Template::class, []);
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <template hidden>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->hidden(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <template id="test-id">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->id('test-id')->render(),
            ),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <template lang="es">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->lang('es')->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template lang="es">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->lang(Language::SPANISH)->render(),
            ),
            "Failed asserting that element renders correctly with 'lang' attribute using enum.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <template itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()
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
            <template>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()
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
            <template>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()
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
            <template>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()
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
            <template role="banner">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->role('banner')->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template role="banner">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->role(Role::BANNER)->render(),
            ),
            "Failed asserting that element renders correctly with 'role' attribute using enum.",
        );
    }

    public function testRenderWithShadowRootClonable(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootclonable>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootClonable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootclonable' attribute.",
        );
    }

    public function testRenderWithShadowRootDelegatesFocus(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootdelegatesfocus>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootDelegatesFocus(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootdelegatesfocus' attribute.",
        );
    }

    public function testRenderWithShadowRootMode(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootmode="open">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootMode('open')->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootmode' attribute.",
        );
    }

    public function testRenderWithShadowRootModeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootmode="open">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootMode(ShadowRootMode::OPEN)->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootmode' attribute using enum.",
        );
    }

    public function testRenderWithShadowRootReferenceTarget(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootreferencetarget="target">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootReferenceTarget('target')->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootreferencetarget' attribute.",
        );
    }

    public function testRenderWithShadowRootSerializable(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootserializable>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->shadowRootSerializable(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'shadowrootserializable' attribute.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <template spellcheck="true">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->spellcheck(true)->render(),
            ),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <template style='value'>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->style('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <template tabindex="3">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->tabIndex(3)->render(),
            ),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <template class="text-muted">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            ),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <template title="value">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->title('value')->render(),
            ),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                (string) Template::tag(),
            ),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <template translate="no">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->translate(false)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template translate="no">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag()->translate(Translate::NO)->render(),
            ),
            "Failed asserting that element renders correctly with 'translate' attribute using enum.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Template::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::assertSame(
            <<<HTML
            <template class="from-global" id="id-user">
            </template>
            HTML,
            LineEndingNormalizer::normalize(
                Template::tag(['id' => 'id-user'])->render(),
            ),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Template::class, []);
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $template = Template::tag();

        self::assertNotSame(
            $template,
            $template->shadowRootClonable(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootDelegatesFocus(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootMode(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootReferenceTarget(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootSerializable(true),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testThrowInvalidArgumentExceptionForSettingShadowRootMode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'shadowrootmode',
                implode("', '", Enum::normalizeArray(ShadowRootMode::cases())),
            ),
        );

        Template::tag()->shadowRootMode('invalid-value');
    }
}
