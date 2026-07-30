<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\Th;
use UIAwesome\Html\Table\Values\Scope;
use UIAwesome\Html\Tests\Provider\Table\ThProvider;

/**
 * Unit tests for {@see Th} rendering and table header cell attribute behavior.
 *
 * {@see ThProvider} for test case data providers.
 */
#[Group('table')]
final class ThTest extends TestCase
{
    #[TestWith(['value', 'value'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithAbbr(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <th abbr="{$expected}">
            </th>
            HTML,
            Th::tag()
                ->abbr($value)
                ->render(),
            "'abbr' must be serialized.",
        );
    }

    #[DataProviderExternal(ThProvider::class, 'colspanValues')]
    public function testRenderWithColspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Th::tag()
                ->colspan($value)
                ->render(),
            "'colspan' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            value
            </th>
            HTML,
            Th::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <th class="default-class">
            </th>
            HTML,
            Th::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            Th::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[TestWith(['value1 value2', 'value1 value2'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithHeaders(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <th headers="{$expected}">
            </th>
            HTML,
            Th::tag()
                ->headers($value)
                ->render(),
            "'headers' must be serialized.",
        );
    }

    #[DataProviderExternal(ThProvider::class, 'rowspanValues')]
    public function testRenderWithRowspanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Th::tag()
                ->rowspan($value)
                ->render(),
            "'rowspan' must be serialized.",
        );
    }

    #[DataProviderExternal(ThProvider::class, 'scope')]
    public function testRenderWithScope(string|Scope $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Th::tag()
                ->scope($value)
                ->render(),
            "'scope' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <th>
            </th>
            HTML,
            (string) Th::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $th = Th::tag();

        self::assertNotSame(
            $th,
            $th->abbr(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->colspan(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->headers(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->rowspan(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $th,
            $th->scope(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Th $setter
     */
    #[DataProviderExternal(ThProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
