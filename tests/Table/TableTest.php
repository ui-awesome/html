<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\{Caption, Col, Colgroup, Table, Tbody, Td, Tfoot, Th, Thead, Tr};

/**
 * Unit tests for {@see Table} rendering and table structure composition behavior.
 */
#[Group('table')]
final class TableTest extends TestCase
{
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
}
