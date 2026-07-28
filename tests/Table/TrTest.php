<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Table\{Td, Th, Tr};

/**
 * Unit tests for {@see Tr} rendering and row composition behavior.
 */
#[Group('table')]
final class TrTest extends TestCase
{
    public function testRenderWithCells(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            <td>
            Jane
            </td>
            <td>
            30
            </td>
            </tr>
            HTML,
            Tr::tag()
                ->cells('Jane', '30')
                ->render(),
            'Cells must be appended.',
        );
    }

    public function testRenderWithCellsUsingStringable(): void
    {
        $name = new class implements Stringable {
            public function __toString(): string
            {
                return 'Jane';
            }
        };

        self::assertSame(
            <<<HTML
            <tr>
            <td>
            Jane
            </td>
            </tr>
            HTML,
            Tr::tag()
                ->cells($name)
                ->render(),
            'Cells must accept Stringable values.',
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            value
            </tr>
            HTML,
            Tr::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <tr class="default-class">
            </tr>
            HTML,
            Tr::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            </tr>
            HTML,
            Tr::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithHeaderCells(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            <th>
            Name
            </th>
            <th>
            Age
            </th>
            </tr>
            HTML,
            Tr::tag()
                ->headerCells('Name', 'Age')
                ->render(),
            'Header cells must be appended.',
        );
    }

    public function testRenderWithHeaderCellsUsingStringable(): void
    {
        $header = new class implements Stringable {
            public function __toString(): string
            {
                return 'Name';
            }
        };

        self::assertSame(
            <<<HTML
            <tr>
            <th>
            Name
            </th>
            </tr>
            HTML,
            Tr::tag()
                ->headerCells($header)
                ->render(),
            'Header cells must accept Stringable values.',
        );
    }

    public function testRenderWithTd(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            <td>
            value
            </td>
            </tr>
            HTML,
            Tr::tag()
                ->td(Td::tag()->content('value'))
                ->render(),
            'Td entries must be appended.',
        );
    }

    public function testRenderWithTh(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            <th>
            value
            </th>
            </tr>
            HTML,
            Tr::tag()
                ->th(Th::tag()->content('value'))
                ->render(),
            'Th entries must be appended.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <tr>
            </tr>
            HTML,
            (string) Tr::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $tr = Tr::tag();

        self::assertNotSame(
            $tr,
            $tr->cells('value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tr,
            $tr->headerCells('value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tr,
            $tr->td(Td::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tr,
            $tr->th(Th::tag()),
            'New instance must be returned (immutability).',
        );
    }
}
