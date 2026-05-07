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
use UIAwesome\Html\Table\{Caption, Col, Colgroup, Table, Tbody, Td, Tfoot, Th, Thead, Tr};
use UIAwesome\Html\Tests\Support\Stub\{DefaultProvider, DefaultThemeProvider};

/**
 * Unit tests for {@see Table} rendering and table structure composition behavior.
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
            'Content must be HTML-encoded.',
        );
    }

    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            Table::tag()->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            ['class' => 'value'],
            Table::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
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
            'Raw HTML content must be applied.',
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
            "'accesskey' must be serialized.",
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
            'ARIA attribute must be added.',
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
            'ARIA attribute must be added.',
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
            'Data attribute must be added.',
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
            'Data attribute must be added.',
        );
    }

    public function testRenderWithAddEvent(): void
    {
        self::assertSame(
            <<<HTML
            <table onclick="alert(&apos;Clicked!&apos;)">
            </table>
            HTML,
            Table::tag()
                ->addEvent('click', "alert('Clicked!')")
                ->render(),
            'Event handler must be added.',
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
            'ARIA attribute map must be applied.',
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
            'Attribute map must be applied.',
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
            "'autofocus' must be serialized.",
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
            'begin/end must produce a complete element.',
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
            'Caption must accept a Caption instance.',
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
            'Caption must accept `null` to drop the element.',
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
            'Caption must accept a string.',
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
            'Caption must HTML-escape string content.',
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
            "'class' must be serialized.",
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
            "'class' must be serialized.",
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
            'Colgroup must be appended.',
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
            'Bare element must render with no attributes.',
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
            "'contentEditable' must be serialized.",
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
            "'contentEditable' must be serialized.",
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
            'Data attribute map must be applied.',
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
            'Constructor configuration must be applied.',
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
            'Default provider must contribute attributes.',
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
            'Bare element must render with no attributes.',
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
            "'dir' must be serialized.",
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
            "'dir' must be serialized.",
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
            "'draggable' must be serialized.",
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
            "'draggable' must be serialized.",
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
                ->thead(Thead::tag()->tr(Tr::tag()->th(Th::tag()->content('Name'))))
                ->tbody(Tbody::tag()->tr(Tr::tag()->td(Td::tag()->content('Jane'))))
                ->tfoot(Tfoot::tag()->tr(Tr::tag()->td(Td::tag()->content('Total'))))
                ->render(),
            'Table widgets must compose into final HTML.',
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
            'Convenience methods must compose a complete table.',
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
            'Factory defaults must be applied.',
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
            "'hidden' must be serialized.",
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
            "'id' must be serialized.",
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
            "'lang' must be serialized.",
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
            "'lang' must be serialized.",
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
            'Microdata attributes must be serialized.',
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
            'ARIA attribute must be removed.',
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
            <table>
            </table>
            HTML,
            Table::tag()
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
            <table role="banner">
            </table>
            HTML,
            Table::tag()
                ->role('banner')
                ->render(),
            "'role' must be serialized.",
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
            "'role' must be serialized.",
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
                ->addAttribute('class', 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
                ->addAttribute(GlobalAttribute::TITLE, 'value')
                ->render(),
            'Arbitrary attribute must be added.',
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
            "'spellcheck' must be serialized.",
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
            "'style' must be serialized.",
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
            "'tabindex' must be serialized.",
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
                ->tbody(Tbody::tag()->tr(Tr::tag()->td(Td::tag()->content('value'))))
                ->render(),
            'Tbody must be appended.',
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
                ->tfoot(Tfoot::tag()->tr(Tr::tag()->td(Td::tag()->content('value'))))
                ->render(),
            'Tfoot must be appended.',
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
                ->thead(Thead::tag()->tr(Tr::tag()->th(Th::tag()->content('value'))))
                ->render(),
            'Thead must be appended.',
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
            'Theme provider must contribute classes.',
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
            "'title' must be serialized.",
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
            'Casting to string must produce HTML.',
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
                ->tr(Tr::tag()->td(Td::tag()->content('value')))
                ->render(),
            'Tr entries must be appended.',
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
            "'translate' must be serialized.",
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
            "'translate' must be serialized.",
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
            'User attributes must take precedence over factory defaults.',
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
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $table,
            $table->colgroup(Colgroup::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $table,
            $table->thead(Thead::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $table,
            $table->tbody(Tbody::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $table,
            $table->tr(Tr::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $table,
            $table->tfoot(Tfoot::tag()),
            'New instance must be returned (immutability).',
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

        Table::tag()->contentEditable('invalid-value');
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

        Table::tag()->dir('invalid-value');
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

        Table::tag()->draggable('invalid-value');
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

        Table::tag()->lang('invalid-value');
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
                implode("', '", Enum::normalizeStringArray(Translate::cases())),
            ),
        );

        Table::tag()->translate('invalid-value');
    }
}
