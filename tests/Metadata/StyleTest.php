<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Blocking, ElementAttribute};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Style;
use UIAwesome\Html\Tests\Provider\Metadata\StyleProvider;

use function implode;

/**
 * Unit tests for {@see Style} rendering and style attribute behavior.
 *
 * {@see StyleProvider} for test case data providers.
 */
#[Group('metadata')]
final class StyleTest extends TestCase
{
    #[DataProviderExternal(StyleProvider::class, 'blocking')]
    public function testRenderWithBlocking(string|Blocking $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <style blocking="{$expected}">
            </style>
            HTML,
            Style::tag()->blocking($value)->render(),
            "'blocking' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <style class="default-class">
            </style>
            HTML,
            Style::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            Style::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <style media="screen">
            </style>
            HTML,
            Style::tag()->media('screen')->render(),
            "'media' must be serialized.",
        );
    }

    public function testRenderWithNonce(): void
    {
        self::assertSame(
            <<<HTML
            <style nonce="nonce-value">
            </style>
            HTML,
            Style::tag()->nonce('nonce-value')->render(),
            "'nonce' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            (string) Style::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(StyleProvider::class, 'type')]
    public function testRenderWithType(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <style type="{$expected}">
            </style>
            HTML,
            Style::tag()->type($value)->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeNull(): void
    {
        self::assertSame(
            <<<HTML
            <style>
            </style>
            HTML,
            Style::tag()->type('text/css')->type(null)->render(),
            '`null` must remove the attribute.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $style = Style::tag();

        self::assertNotSame(
            $style,
            $style->blocking(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $style,
            $style->media(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $style,
            $style->nonce(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $style,
            $style->type(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingBlocking(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::BLOCKING->value,
                implode("', '", Enum::normalizeStringArray(Blocking::cases())),
            ),
        );

        Style::tag()->blocking('invalid-value');
    }
}
