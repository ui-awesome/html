<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\{Tfoot, Tr};

/**
 * Unit tests for {@see Tfoot} rendering and footer row composition behavior.
 */
#[Group('table')]
final class TfootTest extends TestCase
{
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
            'Bare element must render with no attributes.',
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
            'Constructor configuration must be applied.',
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
            'Bare element must render with no attributes.',
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
            'Row must be appended.',
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
            'Rows collection must be applied.',
        );
    }

    public function testRenderWithRowsUsingAssociativeArrays(): void
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
                ->rows(['label' => 'Totals', 'value' => '100'])
                ->render(),
            'Rows must accept associative arrays.',
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
            'Casting to string must produce HTML.',
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
            'Tr entries must be appended.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $tfoot = Tfoot::tag();

        self::assertNotSame(
            $tfoot,
            $tfoot->row('value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tfoot,
            $tfoot->rows(['value']),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tfoot,
            $tfoot->tr(Tr::tag()),
            'New instance must be returned (immutability).',
        );
    }
}
