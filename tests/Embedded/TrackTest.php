<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Embedded\Track;
use UIAwesome\Html\Embedded\Values\Kind;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Embedded\TrackProvider;

use function implode;

/**
 * Unit tests for {@see Track} rendering and track attribute behavior.
 *
 * {@see TrackProvider} for test case data providers.
 */
#[Group('embedded')]
final class TrackTest extends TestCase
{
    public function testRenderWithDefault(): void
    {
        self::assertSame(
            <<<HTML
            <track default>
            HTML,
            Track::tag()
                ->default(true)
                ->render(),
            "'default' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <track class="default-class">
            HTML,
            Track::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <track>
            HTML,
            Track::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[DataProviderExternal(TrackProvider::class, 'kind')]
    public function testRenderWithKind(string|Kind $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <track kind="{$expected}">
            HTML,
            Track::tag()
                ->kind($value)
                ->render(),
            "'kind' must be serialized.",
        );
    }

    #[TestWith(['English', 'English'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithLabel(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <track label="{$expected}">
            HTML,
            Track::tag()
                ->label($value)
                ->render(),
            "'label' must be serialized from both input forms.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <track src="/media/subtitles.vtt">
            HTML,
            Track::tag()
                ->src('/media/subtitles.vtt')
                ->render(),
            "'src' must be serialized.",
        );
    }

    #[TestWith(['en', 'en'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithSrclang(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <track srclang="{$expected}">
            HTML,
            Track::tag()
                ->srclang($value)
                ->render(),
            "'srclang' must be serialized from both input forms.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <track>
            HTML,
            (string) Track::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $track = Track::tag();

        self::assertNotSame(
            $track,
            $track->default(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->kind('subtitles'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->label(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $track,
            $track->srclang(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingKind(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'kind',
                implode("', '", Enum::normalizeStringArray(Kind::cases())),
            ),
        );

        Track::tag()->kind('invalid-value');
    }
}
