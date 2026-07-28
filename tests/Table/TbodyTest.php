<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\{Tbody, Tr};

/**
 * Unit tests for {@see Tbody} rendering and body row composition behavior.
 */
#[Group('table')]
final class TbodyTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <tbody>
            value
            </tbody>
            HTML,
            Tbody::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <tbody class="default-class">
            </tbody>
            HTML,
            Tbody::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <tbody>
            </tbody>
            HTML,
            Tbody::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithRow(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Tbody::tag()
                ->row('Jane', '30')
                ->render(),
            'Row must be appended.',
        );
    }

    public function testRenderWithRows(): void
    {
        self::assertSame(
            <<<HTML
            <tbody>
            <tr>
            <td>
            Jane
            </td>
            <td>
            30
            </td>
            </tr>
            <tr>
            <td>
            John
            </td>
            <td>
            25
            </td>
            </tr>
            </tbody>
            HTML,
            Tbody::tag()
                ->rows(['Jane', '30'], ['John', '25'])
                ->render(),
            'Rows collection must be applied.',
        );
    }

    public function testRenderWithRowsUsingAssociativeArrays(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Tbody::tag()
                ->rows(['name' => 'Jane', 'age' => '30'])
                ->render(),
            'Rows must accept associative arrays.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <tbody>
            </tbody>
            HTML,
            (string) Tbody::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTr(): void
    {
        self::assertSame(
            <<<HTML
            <tbody>
            <tr>
            value
            </tr>
            </tbody>
            HTML,
            Tbody::tag()
                ->tr(Tr::tag()->content('value'))
                ->render(),
            'Tr entries must be appended.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $tbody = Tbody::tag();

        self::assertNotSame(
            $tbody,
            $tbody->row('value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tbody,
            $tbody->rows(['value']),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $tbody,
            $tbody->tr(Tr::tag()),
            'New instance must be returned (immutability).',
        );
    }
}
