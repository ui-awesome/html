<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\{Th, Thead, Tr};

/**
 * Unit tests for {@see Thead} rendering and header row composition behavior.
 */
#[Group('table')]
final class TheadTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <thead>
            value
            </thead>
            HTML,
            Thead::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <thead class="default-class">
            </thead>
            HTML,
            Thead::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <thead>
            </thead>
            HTML,
            Thead::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithRow(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Thead::tag()
                ->row('Name', 'Age')
                ->render(),
            'Row must be appended.',
        );
    }

    public function testRenderWithRows(): void
    {
        self::assertSame(
            <<<HTML
            <thead>
            <tr>
            <th>
            Name
            </th>
            <th>
            Age
            </th>
            </tr>
            <tr>
            <th>
            ID
            </th>
            <th>
            Email
            </th>
            </tr>
            </thead>
            HTML,
            Thead::tag()
                ->rows(['Name', 'Age'], ['ID', 'Email'])
                ->render(),
            'Rows collection must be applied.',
        );
    }

    public function testRenderWithRowsUsingAssociativeArrays(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Thead::tag()
                ->rows(['col1' => 'Name', 'col2' => 'Age'])
                ->render(),
            'Rows must accept associative arrays.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <thead>
            </thead>
            HTML,
            (string) Thead::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithTr(): void
    {
        self::assertSame(
            <<<HTML
            <thead>
            <tr>
            <th>
            value
            </th>
            </tr>
            </thead>
            HTML,
            Thead::tag()
                ->tr(Tr::tag()->th(Th::tag()->content('value')))
                ->render(),
            'Tr entries must be appended.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $thead = Thead::tag();

        self::assertNotSame(
            $thead,
            $thead->row('value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $thead,
            $thead->rows(['value']),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $thead,
            $thead->tr(Tr::tag()),
            'New instance must be returned (immutability).',
        );
    }
}
