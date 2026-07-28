<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\Crossorigin;
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Embedded\Video;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Embedded\VideoProvider;

/**
 * Unit tests for {@see Video} rendering and video attribute behavior.
 *
 * {@see VideoProvider} for test case data providers.
 */
#[Group('embedded')]
final class VideoTest extends TestCase
{
    public function testRenderWithAutoplay(): void
    {
        self::assertSame(
            <<<HTML
            <video autoplay>
            </video>
            HTML,
            Video::tag()
                ->autoplay(true)
                ->render(),
            "'autoplay' must be serialized.",
        );
    }

    public function testRenderWithControls(): void
    {
        self::assertSame(
            <<<HTML
            <video controls>
            </video>
            HTML,
            Video::tag()
                ->controls(true)
                ->render(),
            "'controls' must be serialized.",
        );
    }

    #[DataProviderExternal(VideoProvider::class, 'controlslist')]
    public function testRenderWithControlslist(string|Controlslist $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <video controlslist="{$expected}">
            </video>
            HTML,
            Video::tag()
                ->controlslist($value)
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingMultipleTokens(): void
    {
        self::assertSame(
            <<<HTML
            <video controlslist="nodownload noremoteplayback">
            </video>
            HTML,
            Video::tag()
                ->controlslist('nodownload noremoteplayback')
                ->render(),
            'controlslist must accept space-separated tokens.',
        );
    }

    #[DataProviderExternal(VideoProvider::class, 'crossorigin')]
    public function testRenderWithCrossorigin(string|Crossorigin $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <video crossorigin="{$expected}">
            </video>
            HTML,
            Video::tag()
                ->crossorigin($value)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <video class="default-class">
            </video>
            HTML,
            Video::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            </video>
            HTML,
            Video::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDisablepictureinpicture(): void
    {
        self::assertSame(
            <<<HTML
            <video disablepictureinpicture>
            </video>
            HTML,
            Video::tag()
                ->disablepictureinpicture(true)
                ->render(),
            "'disablepictureinpicture' must be serialized.",
        );
    }

    public function testRenderWithDisableremoteplayback(): void
    {
        self::assertSame(
            <<<HTML
            <video disableremoteplayback>
            </video>
            HTML,
            Video::tag()
                ->disableremoteplayback(true)
                ->render(),
            "'disableremoteplayback' must be serialized.",
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <video height="600">
            </video>
            HTML,
            Video::tag()
                ->height(600)
                ->render(),
            "'height' must be serialized.",
        );
    }

    public function testRenderWithLoop(): void
    {
        self::assertSame(
            <<<HTML
            <video loop>
            </video>
            HTML,
            Video::tag()
                ->loop(true)
                ->render(),
            "'loop' must be serialized.",
        );
    }

    public function testRenderWithMuted(): void
    {
        self::assertSame(
            <<<HTML
            <video muted>
            </video>
            HTML,
            Video::tag()
                ->muted(true)
                ->render(),
            "'muted' must be serialized.",
        );
    }

    public function testRenderWithPlaysinline(): void
    {
        self::assertSame(
            <<<HTML
            <video playsinline>
            </video>
            HTML,
            Video::tag()
                ->playsinline(true)
                ->render(),
            "'playsinline' must be serialized.",
        );
    }

    public function testRenderWithPoster(): void
    {
        self::assertSame(
            <<<HTML
            <video poster="https://example.com/poster.jpg">
            </video>
            HTML,
            Video::tag()
                ->poster('https://example.com/poster.jpg')
                ->render(),
            "'poster' must be serialized.",
        );
    }

    #[DataProviderExternal(VideoProvider::class, 'preload')]
    public function testRenderWithPreload(string|Preload $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <video preload="{$expected}">
            </video>
            HTML,
            Video::tag()
                ->preload($value)
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <video src="value">
            </video>
            HTML,
            Video::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <video>
            </video>
            HTML,
            (string) Video::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <video width="800">
            </video>
            HTML,
            Video::tag()
                ->width(800)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $video = Video::tag();

        self::assertNotSame(
            $video,
            $video->autoplay(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->controls(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->controlslist(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->disablepictureinpicture(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->disableremoteplayback(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->loop(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->muted(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->playsinline(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->poster(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->preload(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $video,
            $video->width(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): Video $setter
     */
    #[DataProviderExternal(VideoProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(
        Closure $setter,
        string $rejected,
        string $attribute,
        string $allowedValues,
    ): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage($rejected, $attribute, $allowedValues),
        );

        $setter();
    }
}
