<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Embedded\Source;

/**
 * Unit tests for {@see Source} rendering and source attribute behavior.
 */
#[Group('embedded')]
final class SourceTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <source class="default-class">
            HTML,
            Source::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <source>
            HTML,
            Source::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <source height="400">
            HTML,
            Source::tag()
                ->height(400)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <source media="(width &gt;= 800px)">
            HTML,
            Source::tag()
                ->media('(width >= 800px)')
                ->render(),
            "'media' must be serialized.",
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <source sizes="(max-width: 600px) 100vw, 50vw">
            HTML,
            Source::tag()
                ->sizes('(max-width: 600px) 100vw, 50vw')
                ->render(),
            "'sizes' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <source src="/media/intro.webm">
            HTML,
            Source::tag()
                ->src('/media/intro.webm')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            <<<HTML
            <source srcset="image-320w.jpg 320w, image-640w.jpg 640w">
            HTML,
            Source::tag()
                ->srcset('image-320w.jpg 320w, image-640w.jpg 640w')
                ->render(),
            "'srcset' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <source>
            HTML,
            (string) Source::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[TestWith(['video/webm', 'video/webm'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithType(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <source type="{$expected}">
            HTML,
            Source::tag()
                ->type($value)
                ->render(),
            "'type' must be serialized from both input forms.",
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <source width="640">
            HTML,
            Source::tag()
                ->width(640)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $source = Source::tag();

        self::assertNotSame(
            $source,
            $source->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->media(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->sizes(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->srcset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->type(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $source,
            $source->width(null),
            'New instance must be returned (immutability).',
        );
    }
}
