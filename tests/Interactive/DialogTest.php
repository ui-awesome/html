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
 * Test coverage.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
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
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Dialog::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Dialog::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
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
            "Failed asserting that element renders correctly with 'html()' method.",
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
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'ariaAttributes()' method.",
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
            "Failed asserting that element renders correctly with 'attributes()' method.",
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
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'class' attribute.",
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
            "Failed asserting that element renders correctly with 'closeButton()' method.",
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
            "Failed asserting that element renders correctly with prepended 'closeButton()' content.",
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
            "Failed asserting that 'closeButton()' uses invoker command when dialog has id.",
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
            "Failed asserting that element renders correctly with 'closedby' attribute.",
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
            "Failed asserting that element renders correctly with 'closedby' attribute.",
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
            'Failed asserting that element renders correctly with default values.',
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
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
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
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
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
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
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
            'Failed asserting that default configuration values are applied correctly.',
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
            'Failed asserting that default provider is applied correctly.',
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'dir' attribute.",
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
            "Failed asserting that element renders correctly with 'draggable' attribute.",
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
            "Failed asserting that element renders correctly with 'draggable' attribute.",
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
            'Failed asserting that global defaults are applied correctly.',
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
            "Failed asserting that element renders correctly with 'hidden' attribute.",
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
            "Failed asserting that element renders correctly with 'id' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            "Failed asserting that element renders correctly with 'lang' attribute.",
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
            'Failed asserting that element renders correctly with microdata attributes.',
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
            "Failed asserting that element renders correctly with 'open' attribute.",
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
            "Failed asserting that element renders correctly with 'removeAriaAttribute()' method.",
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
            <dialog>
            </dialog>
            HTML,
            Dialog::tag()
                ->addDataAttribute('value', 'value')
                ->removeDataAttribute('value')
                ->render(),
            "Failed asserting that element renders correctly with 'removeDataAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
            "Failed asserting that element renders correctly with 'role' attribute.",
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
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
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
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
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
            "Failed asserting that element renders correctly with 'style' attribute.",
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
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
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
            "Failed asserting that element renders correctly with 'title' attribute.",
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
            "Failed asserting that '__toString()' method renders correctly.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            "Failed asserting that element renders correctly with 'translate' attribute.",
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
            'Failed asserting that user-defined attributes override global defaults correctly.',
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
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $dialog,
            $dialog->closedby(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $dialog,
            $dialog->open(null),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testReturnSameInstanceWhenCloseButtonIsNull(): void
    {
        $dialog = Dialog::tag();

        self::assertSame(
            $dialog,
            $dialog->closeButton(null),
            'Should return the same instance when close button is null.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingClosedby(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'closedby',
                implode("', '", Enum::normalizeArray(Closedby::cases())),
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
                implode("', '", Enum::normalizeArray(ContentEditable::cases())),
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
                implode("', '", Enum::normalizeArray(Direction::cases())),
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
                implode("', '", Enum::normalizeArray(Draggable::cases())),
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
                implode("', '", Enum::normalizeArray(Language::cases())),
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
                implode("', '", Enum::normalizeArray(Role::cases())),
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
                implode("', '", Enum::normalizeArray(Translate::cases())),
            ),
        );

        Dialog::tag()->translate('invalid-value');
    }
}
