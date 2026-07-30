<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\{Col, Colgroup};
use UIAwesome\Html\Tests\Provider\Table\ColgroupProvider;

/**
 * Unit tests for {@see Colgroup} rendering and column group behavior.
 *
 * {@see ColgroupProvider} for test case data providers.
 */
#[Group('table')]
final class ColgroupTest extends TestCase
{
    public function testRenderWithCol(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup>
            <col span="2">
            </colgroup>
            HTML,
            Colgroup::tag()
                ->col(
                    Col::tag()->span(2),
                )
                ->render(),
            'Col entries must be appended.',
        );
    }

    public function testRenderWithCols(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup>
            <col class="weekdays" span="2">
            <col class="weekend" span="2">
            </colgroup>
            HTML,
            Colgroup::tag()
                ->cols(
                    Col::tag()->class('weekdays')->span(2),
                    Col::tag()->class('weekend')->span(2),
                )
                ->render(),
            'Cols collection must be applied.',
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup>
            value
            </colgroup>
            HTML,
            Colgroup::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup class="default-class">
            </colgroup>
            HTML,
            Colgroup::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup>
            </colgroup>
            HTML,
            Colgroup::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[DataProviderExternal(ColgroupProvider::class, 'spanValues')]
    public function testRenderWithSpanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Colgroup::tag()
                ->span($value)
                ->render(),
            "'span' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <colgroup>
            </colgroup>
            HTML,
            (string) Colgroup::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $colgroup = Colgroup::tag();

        self::assertNotSame(
            $colgroup,
            $colgroup->col(Col::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $colgroup,
            $colgroup->cols(Col::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $colgroup,
            $colgroup->span(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Colgroup $setter
     */
    #[DataProviderExternal(ColgroupProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
