<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\Col;
use UIAwesome\Html\Tests\Provider\Table\ColProvider;

/**
 * Unit tests for {@see Col} rendering and table column attribute behavior.
 *
 * {@see ColProvider} for test case data providers.
 */
#[Group('table')]
final class ColTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            '<col class="default-class">',
            Col::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            '<col>',
            Col::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[DataProviderExternal(ColProvider::class, 'spanValues')]
    public function testRenderWithSpanValues(int|string $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Col::tag()
                ->span($value)
                ->render(),
            "'span' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<col>',
            (string) Col::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $col = Col::tag();

        self::assertNotSame(
            $col,
            $col->span(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Col $setter
     */
    #[DataProviderExternal(ColProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
