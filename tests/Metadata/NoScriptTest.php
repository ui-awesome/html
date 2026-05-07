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
use UIAwesome\Html\Metadata\NoScript;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see NoScript} rendering and noscript attribute behavior.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('metadata')]
final class NoScriptTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            NoScript::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            NoScript::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            NoScript::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            <value>
            </noscript>
            HTML,
            NoScript::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <noscript accesskey="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-label="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-label="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-value="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-value="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <noscript onclick="alert(&apos;Clicked!&apos;)">
            </noscript>
            HTML,
            NoScript::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <noscript aria-controls="value" aria-label="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->ariaAttributes(
                    [
                        'controls' => 'value',
                        'label' => 'value',
                    ],
                )
                ->render(),
            'ARIA attribute map must be applied.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <noscript autofocus>
            </noscript>
            HTML,
            NoScript::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            Content
            </noscript>
            HTML,
            NoScript::tag()->begin() . 'Content' . NoScript::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            &lt;value&gt;
            </noscript>
            HTML,
            NoScript::tag()
                ->content('<value>')
                ->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <noscript contenteditable="true">
            </noscript>
            HTML,
            NoScript::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript contenteditable="true">
            </noscript>
            HTML,
            NoScript::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <noscript data-value="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            NoScript::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            NoScript::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <noscript dir="ltr">
            </noscript>
            HTML,
            NoScript::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript dir="rtl">
            </noscript>
            HTML,
            NoScript::tag()
                ->dir(Direction::RTL)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <noscript draggable="true">
            </noscript>
            HTML,
            NoScript::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript draggable="true">
            </noscript>
            HTML,
            NoScript::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithEvents(): void
    {
        self::assertSame(
            <<<HTML
            <noscript onfocus="handleFocus()" onblur="handleBlur()">
            </noscript>
            HTML,
            NoScript::tag()
                ->events(
                    [
                        'focus' => 'handleFocus()',
                        'blur' => 'handleBlur()',
                    ],
                )
                ->render(),
            'Event handler map must be applied.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            NoScript::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            NoScript::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            NoScript::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <noscript hidden>
            </noscript>
            HTML,
            NoScript::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <noscript id="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <noscript lang="en">
            </noscript>
            HTML,
            NoScript::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript lang="en">
            </noscript>
            HTML,
            NoScript::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <noscript itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </noscript>
            HTML,
            NoScript::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()
                ->addAriaAttribute('label', 'value')
                ->removeAriaAttribute('label')
                ->render(),
            'ARIA attribute must be removed.',
        );
    }

    public function testRenderWithRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()
                ->addAttribute('class', 'value')
                ->removeAttribute('class')
                ->render(),
            'Attribute must be removed.',
        );
    }

    public function testRenderWithRemoveDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRemoveEvent(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->removeEvent('click')
                ->render(),
            'Event handler must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <noscript role="alert">
            </noscript>
            HTML,
            NoScript::tag()
                ->role('alert')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript role="alert">
            </noscript>
            HTML,
            NoScript::tag()
                ->role(Role::ALERT)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript title="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <noscript spellcheck="true">
            </noscript>
            HTML,
            NoScript::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <noscript style='value'>
            </noscript>
            HTML,
            NoScript::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <noscript tabindex="0">
            </noscript>
            HTML,
            NoScript::tag()
                ->tabIndex(0)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="text-muted">
            </noscript>
            HTML,
            NoScript::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <noscript title="value">
            </noscript>
            HTML,
            NoScript::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            (string) NoScript::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <noscript translate="no">
            </noscript>
            HTML,
            NoScript::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <noscript translate="no">
            </noscript>
            HTML,
            NoScript::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            NoScript::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <noscript class="from-global" id="value">
            </noscript>
            HTML,
            NoScript::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            NoScript::class,
            [],
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingContentEditable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::CONTENTEDITABLE->value,
                implode("', '", Enum::normalizeStringArray(ContentEditable::cases())),
            ),
        );

        NoScript::tag()->contentEditable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDir(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DIR->value,
                implode("', '", Enum::normalizeStringArray(Direction::cases())),
            ),
        );

        NoScript::tag()->dir('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingDraggable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::DRAGGABLE->value,
                implode("', '", Enum::normalizeStringArray(Draggable::cases())),
            ),
        );

        NoScript::tag()->draggable('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingLang(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::LANG->value,
                implode("', '", Enum::normalizeStringArray(Language::cases())),
            ),
        );

        NoScript::tag()->lang('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::ROLE->value,
                implode("', '", Enum::normalizeStringArray(Role::cases())),
            ),
        );

        NoScript::tag()->role('invalid-value');
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        NoScript::tag()->tabIndex(-2);
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTranslate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                GlobalAttribute::TRANSLATE->value,
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        NoScript::tag()->translate('invalid-value');
    }
}
