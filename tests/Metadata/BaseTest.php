<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Attribute, Target};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Base;
use UIAwesome\Html\Tests\Provider\Metadata\BaseProvider;

use function implode;

/**
 * Unit tests for {@see Base} rendering and base attribute behavior.
 *
 * {@see BaseProvider} for test case data providers.
 */
#[Group('metadata')]
final class BaseTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <base class="default-class">
            HTML,
            Base::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <base>
            HTML,
            Base::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <base href="value">
            HTML,
            Base::tag()->href('value')->render(),
            "'href' must be serialized.",
        );
    }

    #[DataProviderExternal(BaseProvider::class, 'target')]
    public function testRenderWithTarget(string|Target $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <base target="{$expected}">
            HTML,
            Base::tag()->target($value)->render(),
            "'target' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<base>',
            (string) Base::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTarget(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                Attribute::TARGET->value,
                implode("', '", Enum::normalizeStringArray(Target::cases())),
            ),
        );

        Base::tag()->target('invalid-value');
    }
}
