<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Interactive;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
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
use UIAwesome\Html\Form\Button;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Interactive\Dialog;
use UIAwesome\Html\Interactive\Values\Closedby;
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Dialog} rendering and global attribute behavior.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('interactive')]
final class DialogTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Dialog::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Dialog::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Dialog::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            <value>
            </dialog>
            HTML,
            Dialog::tag()
                ->html('<value>')
                ->render(),
            'Raw HTML content must be applied.',
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <dialog accesskey="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->accesskey('value')
                ->render(),
            "'accesskey' must be serialized.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dialog aria-label="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog aria-label="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            'ARIA attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dialog data-value="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog data-value="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <dialog onclick="alert(&apos;Clicked!&apos;)">
            </dialog>
            HTML,
            Dialog::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dialog aria-controls="value" aria-label="value">
            </dialog>
            HTML,
            Dialog::tag()
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
            <dialog class="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <dialog autofocus>
            </dialog>
            HTML,
            Dialog::tag()
                ->autofocus(true)
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            Content
            </dialog>
            HTML,
            Dialog::tag()->begin() . 'Content' . Dialog::end(),
            'begin/end must produce a complete element.',
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->class('value')
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "'class' must be serialized.",
        );
    }

    public function testRenderWithCloseButton(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            <form method="dialog">
            <button>Close</button>
            </form>
            </dialog>
            HTML,
            Dialog::tag()
                ->closeButton('Close')
                ->render(),
            'Close button must be rendered.',
        );
    }

    public function testRenderWithCloseButtonPrependsContent(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            <form method="dialog">
            <button>Close</button>
            </form>
            value
            </dialog>
            HTML,
            Dialog::tag()
                ->content('value')
                ->closeButton(Button::tag()->content('Close'))
                ->render(),
            'Close button content must be prepended.',
        );
    }

    public function testRenderWithCloseButtonUsingInvokerCommandWhenDialogHasId(): void
    {
        self::assertSame(
            <<<HTML
            <dialog id="my-dialog">
            <button command="close" commandfor="my-dialog">Close</button>
            </dialog>
            HTML,
            Dialog::tag()
                ->id('my-dialog')
                ->closeButton('Close')
                ->render(),
            'Close button must emit invoker command when dialog has id.',
        );
    }

    public function testRenderWithClosedby(): void
    {
        self::assertSame(
            <<<HTML
            <dialog closedby="closerequest">
            </dialog>
            HTML,
            Dialog::tag()
                ->closedby('closerequest')
                ->render(),
            "'closedby' must be serialized.",
        );
    }

    public function testRenderWithClosedbyUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog closedby="closerequest">
            </dialog>
            HTML,
            Dialog::tag()
                ->closedby(Closedby::CLOSEREQUEST)
                ->render(),
            "'closedby' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            value
            </dialog>
            HTML,
            Dialog::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <dialog contenteditable="true">
            </dialog>
            HTML,
            Dialog::tag()
                ->contentEditable(true)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog contenteditable="true">
            </dialog>
            HTML,
            Dialog::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "'contentEditable' must be serialized.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <dialog data-value="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            'Data attribute map must be applied.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="default-class">
            </dialog>
            HTML,
            Dialog::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="default-class">
            </dialog>
            HTML,
            Dialog::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Default provider must contribute attributes.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <dialog dir="ltr">
            </dialog>
            HTML,
            Dialog::tag()
                ->dir('ltr')
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog dir="ltr">
            </dialog>
            HTML,
            Dialog::tag()
                ->dir(Direction::LTR)
                ->render(),
            "'dir' must be serialized.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <dialog draggable="true">
            </dialog>
            HTML,
            Dialog::tag()
                ->draggable(true)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog draggable="true">
            </dialog>
            HTML,
            Dialog::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "'draggable' must be serialized.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Dialog::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <dialog class="default-class">
            </dialog>
            HTML,
            Dialog::tag()->render(),
            'Factory defaults must be applied.',
        );

        SimpleFactory::setDefaults(
            Dialog::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <dialog hidden>
            </dialog>
            HTML,
            Dialog::tag()
                ->hidden(true)
                ->render(),
            "'hidden' must be serialized.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <dialog id="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->id('value')
                ->render(),
            "'id' must be serialized.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <dialog lang="en">
            </dialog>
            HTML,
            Dialog::tag()
                ->lang('en')
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog lang="en">
            </dialog>
            HTML,
            Dialog::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "'lang' must be serialized.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <dialog itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </dialog>
            HTML,
            Dialog::tag()
                ->itemId('https://example.com/item')
                ->itemProp('name')
                ->itemRef('info')
                ->itemScope(true)
                ->itemType('https://schema.org/Thing')
                ->render(),
            'Microdata attributes must be serialized.',
        );
    }

    public function testRenderWithOpen(): void
    {
        self::assertSame(
            <<<HTML
            <dialog open>
            </dialog>
            HTML,
            Dialog::tag()
                ->open(true)
                ->render(),
            "'open' must be serialized.",
        );
    }

    public function testRenderWithRemoveAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            </dialog>
            HTML,
            Dialog::tag()
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
            <dialog>
            </dialog>
            HTML,
            Dialog::tag()
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
            <dialog>
            </dialog>
            HTML,
            Dialog::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            'Data attribute must be removed.',
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <dialog role="banner">
            </dialog>
            HTML,
            Dialog::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog role="banner">
            </dialog>
            HTML,
            Dialog::tag()
                ->role(Role::BANNER)
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog title="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <dialog spellcheck="true">
            </dialog>
            HTML,
            Dialog::tag()
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <dialog style='value'>
            </dialog>
            HTML,
            Dialog::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <dialog tabindex="3">
            </dialog>
            HTML,
            Dialog::tag()
                ->tabIndex(3)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <dialog class="text-muted">
            </dialog>
            HTML,
            Dialog::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            'Theme provider must contribute classes.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <dialog title="value">
            </dialog>
            HTML,
            Dialog::tag()
                ->title('value')
                ->render(),
            "'title' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dialog>
            </dialog>
            HTML,
            (string) Dialog::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <dialog translate="no">
            </dialog>
            HTML,
            Dialog::tag()
                ->translate(false)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <dialog translate="no">
            </dialog>
            HTML,
            Dialog::tag()
                ->translate(Translate::NO)
                ->render(),
            "'translate' must be serialized.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Dialog::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <dialog class="from-global" id="value">
            </dialog>
            HTML,
            Dialog::tag(['id' => 'value'])->render(),
            'User attributes must take precedence over factory defaults.',
        );

        SimpleFactory::setDefaults(
            Dialog::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $dialog = Dialog::tag();

        self::assertNotSame(
            $dialog,
            $dialog->closeButton('Close'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dialog,
            $dialog->closedby(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $dialog,
            $dialog->open(null),
            'New instance must be returned (immutability).',
        );
    }

    public function testReturnSameInstanceWhenCloseButtonIsNull(): void
    {
        $dialog = Dialog::tag();

        self::assertSame(
            $dialog,
            $dialog->closeButton(null),
            'Same instance must be returned for `null` (no-op setter).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingClosedby(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'closedby',
                implode("', '", Enum::normalizeStringArray(Closedby::cases())),
            ),
        );

        Dialog::tag()->closedby('invalid-value');
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

        Dialog::tag()->contentEditable('invalid-value');
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

        Dialog::tag()->dir('invalid-value');
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

        Dialog::tag()->draggable('invalid-value');
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

        Dialog::tag()->lang('invalid-value');
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

        Dialog::tag()->role('invalid-value');
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

        Dialog::tag()->tabIndex(-2);
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

        Dialog::tag()->translate('invalid-value');
    }
}
