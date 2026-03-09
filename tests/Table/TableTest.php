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
use UIAwesome\Html\Table\{Caption, Col, Colgroup, Table, Tbody, Tfoot, Thead, Tr};
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Table} rendering and table structure composition behavior.
 *
 * Test coverage.
 * - Appends table child elements using `caption()`, `colgroup()`, `thead()`, `tbody()`, `tr()`, and `tfoot()`.
 * - Applies global and custom attributes, including `aria-*`, `data-*` and enum-backed values.
 * - Composes a full table structure using convenience methods (`caption()` with string, `row()`, `rows()`).
 * - Ensures attribute accessors return assigned values and fallback defaults.
 * - Renders content, raw HTML, begin/end usage, and string casting with expected encoding behavior.
 * - Resolves default and theme providers, including global defaults and user overrides.
 * - Verifies invalid values throw {@see InvalidArgumentException}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('table')]
final class TableTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Table::tag()
                ->content('<value>')
                ->getContent(),
            "Failed asserting that 'content()' method encodes values correctly.",
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Table::tag()->getAttribute('class', 'value'),
            "Failed asserting that 'getAttribute()' returns the default value when missing.",
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Table::tag()
                ->setAttribute('class', 'value')
                ->getAttributes(),
            "Failed asserting that 'getAttributes()' returns the assigned attributes.",
        );
    }

    public function testHtmlDoesNotEncodeValues(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <value>
            </table>
            HTML,
            Table::tag()
                ->html('<value>')
                ->render(),
            "Failed asserting that element renders correctly with 'html()' method.",
        );
    }

    public function testRenderWithAccesskey(): void
    {
        self::assertSame(
            <<<HTML
            <table accesskey="value">
            </table>
            HTML,
            Table::tag()
                ->accesskey('value')
                ->render(),
            "Failed asserting that element renders correctly with 'accesskey' attribute.",
        );
    }

    public function testRenderWithAddAriaAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <table aria-label="value">
            </table>
            HTML,
            Table::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddAriaAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table aria-label="value">
            </table>
            HTML,
            Table::tag()
                ->addAriaAttribute(Aria::LABEL, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addAriaAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <table data-value="value">
            </table>
            HTML,
            Table::tag()
                ->addDataAttribute('value', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAddDataAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table data-value="value">
            </table>
            HTML,
            Table::tag()
                ->addDataAttribute(Data::VALUE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'addDataAttribute()' method.",
        );
    }

    public function testRenderWithAriaAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <table aria-controls="value" aria-label="value">
            </table>
            HTML,
            Table::tag()
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
            <table class="value">
            </table>
            HTML,
            Table::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <table autofocus>
            </table>
            HTML,
            Table::tag()
                ->autofocus(true)
                ->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            Content
            </table>
            HTML,
            Table::tag()->begin() . 'Content' . Table::end(),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithCaption(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <caption>
            value
            </caption>
            </table>
            HTML,
            Table::tag()
                ->caption(Caption::tag()->content('value'))
                ->render(),
            "Failed asserting that element renders correctly with 'caption()' method using Caption instance.",
        );
    }

    public function testRenderWithCaptionNull(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            </table>
            HTML,
            Table::tag()
                ->caption(null)
                ->render(),
            "Failed asserting that element renders correctly with 'caption()' method using `null`.",
        );
    }

    public function testRenderWithCaptionString(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <caption>
            Monthly report
            </caption>
            </table>
            HTML,
            Table::tag()
                ->caption('Monthly report')
                ->render(),
            "Failed asserting that element renders correctly with 'caption()' method using string.",
        );
    }

    public function testRenderWithCaptionStringEscapesHtml(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <caption>
            &lt;em&gt;Members&lt;/em&gt;
            </caption>
            </table>
            HTML,
            Table::tag()
                ->caption('<em>Members</em>')
                ->render(),
            "Failed asserting that 'caption()' method escapes HTML when using string.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::assertSame(
            <<<HTML
            <table class="value">
            </table>
            HTML,
            Table::tag()
                ->class('value')
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithClassUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table class="value">
            </table>
            HTML,
            Table::tag()
                ->class(BackedString::VALUE)
                ->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithColgroup(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <colgroup>
            <col span="2">
            </colgroup>
            </table>
            HTML,
            Table::tag()
                ->colgroup(Colgroup::tag()->col(Col::tag()->span(2)))
                ->render(),
            "Failed asserting that element renders correctly with 'colgroup()' method.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            value
            </table>
            HTML,
            Table::tag()
                ->content('value')
                ->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithContentEditable(): void
    {
        self::assertSame(
            <<<HTML
            <table contenteditable="true">
            </table>
            HTML,
            Table::tag()
                ->contentEditable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithContentEditableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table contenteditable="true">
            </table>
            HTML,
            Table::tag()
                ->contentEditable(ContentEditable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <table data-value="value">
            </table>
            HTML,
            Table::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <table class="default-class">
            </table>
            HTML,
            Table::tag(['class' => 'default-class'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::assertSame(
            <<<HTML
            <table class="default-class">
            </table>
            HTML,
            Table::tag()
                ->addDefaultProvider(DefaultProvider::class)
                ->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            </table>
            HTML,
            Table::tag()->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithDir(): void
    {
        self::assertSame(
            <<<HTML
            <table dir="ltr">
            </table>
            HTML,
            Table::tag()
                ->dir('ltr')
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDirUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table dir="ltr">
            </table>
            HTML,
            Table::tag()
                ->dir(Direction::LTR)
                ->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::assertSame(
            <<<HTML
            <table draggable="true">
            </table>
            HTML,
            Table::tag()
                ->draggable(true)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithDraggableUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table draggable="true">
            </table>
            HTML,
            Table::tag()
                ->draggable(Draggable::TRUE)
                ->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithFullTableStructure(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <caption>
            Members
            </caption>
            <colgroup>
            <col span="2">
            </colgroup>
            <thead>
            <tr>
            <th>
            Name
            </th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>
            Jane
            </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
            <td>
            Total
            </td>
            </tr>
            </tfoot>
            </table>
            HTML,
            Table::tag()
                ->caption(Caption::tag()->content('Members'))
                ->colgroup(Colgroup::tag()->col(Col::tag()->span(2)))
                ->thead(Thead::tag()->tr(Tr::tag()->th(\UIAwesome\Html\Table\Th::tag()->content('Name'))))
                ->tbody(Tbody::tag()->tr(Tr::tag()->td(\UIAwesome\Html\Table\Td::tag()->content('Jane'))))
                ->tfoot(Tfoot::tag()->tr(Tr::tag()->td(\UIAwesome\Html\Table\Td::tag()->content('Total'))))
                ->render(),
            'Failed asserting that complete table widgets compose correctly into the final HTML.',
        );
    }

    public function testRenderWithFullTableStructureUsingConvenienceMethods(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <caption>
            Members
            </caption>
            <thead>
            <tr>
            <th>
            Name
            </th>
            <th>
            Age
            </th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>
            Jane
            </td>
            <td>
            30
            </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
            <td>
            Total
            </td>
            <td>
            1
            </td>
            </tr>
            </tfoot>
            </table>
            HTML,
            Table::tag()
                ->caption('Members')
                ->thead(Thead::tag()->row('Name', 'Age'))
                ->tbody(Tbody::tag()->row('Jane', '30'))
                ->tfoot(Tfoot::tag()->row('Total', '1'))
                ->render(),
            'Failed asserting that complete table composes correctly using convenience methods.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(
            Table::class,
            ['class' => 'default-class'],
        );

        self::assertSame(
            <<<HTML
            <table class="default-class">
            </table>
            HTML,
            Table::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(
            Table::class,
            [],
        );
    }

    public function testRenderWithHidden(): void
    {
        self::assertSame(
            <<<HTML
            <table hidden>
            </table>
            HTML,
            Table::tag()
                ->hidden(true)
                ->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <table id="value">
            </table>
            HTML,
            Table::tag()
                ->id('value')
                ->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::assertSame(
            <<<HTML
            <table lang="en">
            </table>
            HTML,
            Table::tag()
                ->lang('en')
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithLangUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table lang="en">
            </table>
            HTML,
            Table::tag()
                ->lang(Language::ENGLISH)
                ->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithMicroData(): void
    {
        self::assertSame(
            <<<HTML
            <table itemid="https://example.com/item" itemprop="name" itemref="info" itemscope itemtype="https://schema.org/Thing">
            </table>
            HTML,
            Table::tag()
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
            <table>
            </table>
            HTML,
            Table::tag()
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
            <table>
            </table>
            HTML,
            Table::tag()
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
            <table>
            </table>
            HTML,
            Table::tag()
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
            <table role="banner">
            </table>
            HTML,
            Table::tag()
                ->role('banner')
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table role="banner">
            </table>
            HTML,
            Table::tag()
                ->role(Role::BANNER)
                ->render(),
            "Failed asserting that element renders correctly with 'role' attribute.",
        );
    }

    public function testRenderWithSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <table class="value">
            </table>
            HTML,
            Table::tag()
                ->setAttribute('class', 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSetAttributeUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table title="value">
            </table>
            HTML,
            Table::tag()
                ->setAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            "Failed asserting that element renders correctly with 'setAttribute()' method.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <table spellcheck="true">
            </table>
            HTML,
            Table::tag()
                ->spellcheck(true)
                ->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <table style='value'>
            </table>
            HTML,
            Table::tag()
                ->style('value')
                ->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <table tabindex="3">
            </table>
            HTML,
            Table::tag()
                ->tabIndex(3)
                ->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
        );
    }

    public function testRenderWithTbody(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <tbody>
            <tr>
            <td>
            value
            </td>
            </tr>
            </tbody>
            </table>
            HTML,
            Table::tag()
                ->tbody(Tbody::tag()->tr(Tr::tag()->td(\UIAwesome\Html\Table\Td::tag()->content('value'))))
                ->render(),
            "Failed asserting that element renders correctly with 'tbody()' method.",
        );
    }

    public function testRenderWithTfoot(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <tfoot>
            <tr>
            <td>
            value
            </td>
            </tr>
            </tfoot>
            </table>
            HTML,
            Table::tag()
                ->tfoot(Tfoot::tag()->tr(Tr::tag()->td(\UIAwesome\Html\Table\Td::tag()->content('value'))))
                ->render(),
            "Failed asserting that element renders correctly with 'tfoot()' method.",
        );
    }

    public function testRenderWithThead(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <thead>
            <tr>
            <th>
            value
            </th>
            </tr>
            </thead>
            </table>
            HTML,
            Table::tag()
                ->thead(Thead::tag()->tr(Tr::tag()->th(\UIAwesome\Html\Table\Th::tag()->content('value'))))
                ->render(),
            "Failed asserting that element renders correctly with 'thead()' method.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::assertSame(
            <<<HTML
            <table class="text-muted">
            </table>
            HTML,
            Table::tag()
                ->addThemeProvider('muted', DefaultThemeProvider::class)
                ->render(),
            "Failed asserting that element renders correctly with 'addThemeProvider()' method.",
        );
    }

    public function testRenderWithTitle(): void
    {
        self::assertSame(
            <<<HTML
            <table title="value">
            </table>
            HTML,
            Table::tag()
                ->title('value')
                ->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            </table>
            HTML,
            (string) Table::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithTr(): void
    {
        self::assertSame(
            <<<HTML
            <table>
            <tr>
            <td>
            value
            </td>
            </tr>
            </table>
            HTML,
            Table::tag()
                ->tr(Tr::tag()->td(\UIAwesome\Html\Table\Td::tag()->content('value')))
                ->render(),
            "Failed asserting that element renders correctly with 'tr()' method.",
        );
    }

    public function testRenderWithTranslate(): void
    {
        self::assertSame(
            <<<HTML
            <table translate="no">
            </table>
            HTML,
            Table::tag()
                ->translate(false)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithTranslateUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <table translate="no">
            </table>
            HTML,
            Table::tag()
                ->translate(Translate::NO)
                ->render(),
            "Failed asserting that element renders correctly with 'translate' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(
            Table::class,
            [
                'class' => 'from-global',
                'id' => 'id-global',
            ],
        );

        self::assertSame(
            <<<HTML
            <table class="from-global" id="value">
            </table>
            HTML,
            Table::tag(['id' => 'value'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(
            Table::class,
            [],
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $table = Table::tag();

        self::assertNotSame(
            $table,
            $table->caption('value'),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $table,
            $table->colgroup(Colgroup::tag()),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $table,
            $table->thead(Thead::tag()),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $table,
            $table->tbody(Tbody::tag()),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $table,
            $table->tr(Tr::tag()),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
        self::assertNotSame(
            $table,
            $table->tfoot(Tfoot::tag()),
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

        Table::tag()->contentEditable('invalid-value');
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

        Table::tag()->dir('invalid-value');
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

        Table::tag()->draggable('invalid-value');
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

        Table::tag()->lang('invalid-value');
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

        Table::tag()->role('invalid-value');
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

        Table::tag()->tabIndex(-2);
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

        Table::tag()->translate('invalid-value');
    }
}
