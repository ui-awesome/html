<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\Td;
use UIAwesome\Html\Tests\Provider\Table\TdProvider;

/**
 * Unit tests for {@see Td} rendering and table cell attribute behavior.
 *
 * {@see TdProvider} for test case data providers.
 */
#[Group('table')]
final class TdTest extends TestCase
{
    #[DataProviderExternal(TdProvider::class, 'colspanValues')]
    public function testRenderWithColspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Td::tag()
                ->colspan($value)
                ->render(),
            "'colspan' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <td>
            value
            </td>
            HTML,
            Td::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <td class="default-class">
            </td>
            HTML,
            Td::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <td>
            </td>
            HTML,
            Td::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[TestWith(['value1 value2', 'value1 value2'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithHeaders(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <td headers="{$expected}">
            </td>
            HTML,
            Td::tag()
                ->headers($value)
                ->render(),
            "'headers' must be serialized.",
        );
    }

    #[DataProviderExternal(TdProvider::class, 'rowspanValues')]
    public function testRenderWithRowspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Td::tag()
                ->rowspan($value)
                ->render(),
            "'rowspan' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <td>
            </td>
            HTML,
            (string) Td::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $td = Td::tag();

        self::assertNotSame(
            $td,
            $td->colspan(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $td,
            $td->headers(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $td,
            $td->rowspan(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Td $setter
     */
    #[DataProviderExternal(TdProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
