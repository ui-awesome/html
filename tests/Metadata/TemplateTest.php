<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
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
 * - Applies global and custom attributes, including `aria-*`, `data-*`, `on*` and enum-backed values.
 * - Applies template specific attributes (`shadowrootclonable`, `shadowrootdelegatesfocus`, `shadowrootmode`,
 *   `shadowrootreferencetarget`, `shadowrootserializable`) and renders expected output.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid enumerated values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('metadata')]
final class TemplateTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Template::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Template::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Template::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
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
            Template::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <template accesskey="value">
            </template>
            HTML,
            Template::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-label="value">
            </template>
            HTML,
            Template::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-label="value">
            </template>
            HTML,
            Template::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template data-value="value">
            </template>
            HTML,
            Template::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
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
            Template::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <template onclick="alert(&apos;Clicked!&apos;)">
            </template>
            HTML,
            Template::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            "Failed asserting that element renders correctly with 'addEvent()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <template aria-controls="value" aria-label="value">
            </template>
            HTML,
            Template::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                    ->render(),
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
            Template::tag()
                ->attributes(['class' => 'value'])
                ->render(),
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
            Template::tag()
                ->autofocus(true)
                ->render(),
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
            Template::tag()->begin() . 'Content' . Template::end(),
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
            Template::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            &lt;value&gt;
            </template>
            HTML,
            Template::tag()
                ->content('<value>')
                ->render(),
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
            Template::tag()
                ->contentEditable(true)
                ->render(),
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
            Template::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <template data-value="value">
            </template>
            HTML,
            Template::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
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
            Template::tag(['class' => 'default-class'])->render(),
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
            Template::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
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
            Template::tag()->render(),
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
            Template::tag()
                ->dir('ltr')
                ->render(),
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
            Template::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <template draggable="true">
            </template>
            HTML,
            Template::tag()
                ->draggable(true)
                ->render(),
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
            Template::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <template onfocus="handleFocus()" onblur="handleBlur()">
            </template>
            HTML,
            Template::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            "Failed asserting that element renders correctly with 'events()' method.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Template::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <template class="default-class">
            </template>
            HTML,
            Template::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Template::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <template hidden>
            </template>
            HTML,
            Template::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <template id="value">
            </template>
            HTML,
            Template::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <template lang="en">
            </template>
            HTML,
            Template::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template lang="en">
            </template>
            HTML,
            Template::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <template itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </template>
            HTML,
            Template::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
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
            Template::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
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
            Template::tag()
                ->setAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
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
            Template::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            </template>
            HTML,
            Template::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            "Failed asserting that element renders correctly with 'removeEvent()' method.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <template role="banner">
            </template>
            HTML,
            Template::tag()
                ->role('banner')
                ->render(),
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
            Template::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <template class="value">
            </template>
            HTML,
            Template::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <template title="value">
            </template>
            HTML,
            Template::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithShadowRootClonable(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootclonable>
            </template>
            HTML,
            Template::tag()
                ->shadowRootClonable(true)
                ->render(),
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
            Template::tag()
                ->shadowRootDelegatesFocus(true)
                ->render(),
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
            Template::tag()
                ->shadowRootMode('open')
                ->render(),
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
            Template::tag()
                ->shadowRootMode(ShadowRootMode::OPEN)
                ->render(),
            "Failed asserting that element renders correctly with 'shadowrootmode' attribute.",
        );
    }

    public function testRenderWithShadowRootReferenceTarget(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootreferencetarget="value">
            </template>
            HTML,
            Template::tag()
                ->shadowRootReferenceTarget('value')
                ->render(),
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
            Template::tag()
                ->shadowRootSerializable(true)
                ->render(),
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
            Template::tag()
                ->spellcheck(true)
                ->render(),
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
            Template::tag()
                ->style('value')
                ->render(),
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
            Template::tag()
                ->tabIndex(3)
                ->render(),
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
            Template::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
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
            Template::tag()
                ->title('value')
                ->render(),
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
            (string) Template::tag(),
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
            Template::tag()
                ->translate(false)
                ->render(),
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
            Template::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Template::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <template class="from-global" id="value">
            </template>
            HTML,
            Template::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Template::class,
            [],
        );
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

    public function testThrowInvalidArgumentExceptionWhenSettingShadowRootMode(): void
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
