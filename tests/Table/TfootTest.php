<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

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
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Table\{Tfoot, Tr};
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Tfoot} rendering and footer row composition behavior.
 *
 * Test coverage.
 * - Appends table footer rows using `tr()`, `row()`, and `rows()` and renders expected output.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, begin/end usage, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('table')]
final class TfootTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Tfoot::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Tfoot::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Tfoot::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            <value>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot accesskey="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot aria-label="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot aria-label="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot data-value="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot data-value="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot aria-controls="value" aria-label="value">
            </tfoot>
            HTML,
            Tfoot::tag()
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
            <tfoot class="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot autofocus>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            Content
            </tfoot>
            HTML,
            Tfoot::tag()->begin() . 'Content' . Tfoot::end(),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            value
            </tfoot>
            HTML,
            Tfoot::tag()
                ->content('value')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot contenteditable="true">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->contentEditable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot contenteditable="true">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot data-value="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="default-class">
            </tfoot>
            HTML,
            Tfoot::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="default-class">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            </tfoot>
            HTML,
            Tfoot::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot dir="ltr">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot dir="ltr">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot draggable="true">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->draggable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot draggable="true">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Tfoot::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <tfoot class="default-class">
            </tfoot>
            HTML,
            Tfoot::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Tfoot::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot hidden>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot id="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot lang="en">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot lang="en">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </tfoot>
            HTML,
            Tfoot::tag()
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
            <tfoot>
            </tfoot>
            HTML,
            Tfoot::tag()
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
            <tfoot>
            </tfoot>
            HTML,
            Tfoot::tag()
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
            <tfoot>
            </tfoot>
            HTML,
            Tfoot::tag()
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
            <tfoot role="banner">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->role('banner')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot role="banner">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRow(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            <tr>
            <td>
            Totals
            </td>
            <td>
            100
            </td>
            </tr>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->row('Totals', '100')
                ->render(),
            "Failed asserting that element renders correctly with 'row()' method.",
        );
    }

    public function testRenderWithRows(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            <tr>
            <td>
            Subtotal
            </td>
            <td>
            80
            </td>
            </tr>
            <tr>
            <td>
            Total
            </td>
            <td>
            100
            </td>
            </tr>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->rows(['Subtotal', '80'], ['Total', '100'])
                ->render(),
            "Failed asserting that element renders correctly with 'rows()' method.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot title="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot spellcheck="true">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot style='value'>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot tabindex="3">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->tabIndex(3)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot class="text-muted">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot title="value">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            </tfoot>
            HTML,
            (string) Tfoot::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTr(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot>
            <tr>
            value
            </tr>
            </tfoot>
            HTML,
            Tfoot::tag()
                ->tr(Tr::tag()->content('value'))
                ->render(),
            "Failed asserting that element renders correctly with 'tr()' method.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot translate="no">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <tfoot translate="no">
            </tfoot>
            HTML,
            Tfoot::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Tfoot::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <tfoot class="from-global" id="value">
            </tfoot>
            HTML,
            Tfoot::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Tfoot::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $tfoot = Tfoot::tag();

        self::assertNotSame(
            $tfoot,
            $tfoot->row('value'),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $tfoot,
            $tfoot->rows(['value']),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $tfoot,
            $tfoot->tr(Tr::tag()),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
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

        Tfoot::tag()->contentEditable('invalid-value');
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

        Tfoot::tag()->dir('invalid-value');
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

        Tfoot::tag()->draggable('invalid-value');
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

        Tfoot::tag()->lang('invalid-value');
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

        Tfoot::tag()->role('invalid-value');
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

        Tfoot::tag()->tabIndex(-2);
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

        Tfoot::tag()->translate('invalid-value');
    }
}
