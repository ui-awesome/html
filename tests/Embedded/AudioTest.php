<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\Crossorigin;
use UIAwesome\Html\Embedded\Audio;
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Embedded\AudioProvider;

/**
 * Unit tests for {@see Audio} rendering and audio attribute behavior.
 *
 * {@see AudioProvider} for test case data providers.
 */
#[Group('embedded')]
final class AudioTest extends TestCase
{
    public function testRenderWithAutoplay(): void
    {
        self::assertSame(
            <<<HTML
            <audio autoplay>
            </audio>
            HTML,
            Audio::tag()
                ->autoplay(true)
                ->render(),
            "'autoplay' must be serialized.",
        );
    }

    public function testRenderWithControls(): void
    {
        self::assertSame(
            <<<HTML
            <audio controls>
            </audio>
            HTML,
            Audio::tag()
                ->controls(true)
                ->render(),
            "'controls' must be serialized.",
        );
    }

    #[DataProviderExternal(AudioProvider::class, 'controlslist')]
    public function testRenderWithControlslist(string|Controlslist $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <audio controlslist="{$expected}">
            </audio>
            HTML,
            Audio::tag()
                ->controlslist($value)
                ->render(),
            "'controlslist' must be serialized.",
        );
    }

    public function testRenderWithControlslistUsingMultipleTokens(): void
    {
        self::assertSame(
            <<<HTML
            <audio controlslist="nodownload noremoteplayback">
            </audio>
            HTML,
            Audio::tag()
                ->controlslist('nodownload noremoteplayback')
                ->render(),
            'controlslist must accept space-separated tokens.',
        );
    }

    #[DataProviderExternal(AudioProvider::class, 'crossorigin')]
    public function testRenderWithCrossorigin(string|Crossorigin $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <audio crossorigin="{$expected}">
            </audio>
            HTML,
            Audio::tag()
                ->crossorigin($value)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <audio class="default-class">
            </audio>
            HTML,
            Audio::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            </audio>
            HTML,
            Audio::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDisableremoteplayback(): void
    {
        self::assertSame(
            <<<HTML
            <audio disableremoteplayback>
            </audio>
            HTML,
            Audio::tag()
                ->disableremoteplayback(true)
                ->render(),
            "'disableremoteplayback' must be serialized.",
        );
    }

    public function testRenderWithLoop(): void
    {
        self::assertSame(
            <<<HTML
            <audio loop>
            </audio>
            HTML,
            Audio::tag()
                ->loop(true)
                ->render(),
            "'loop' must be serialized.",
        );
    }

    public function testRenderWithMuted(): void
    {
        self::assertSame(
            <<<HTML
            <audio muted>
            </audio>
            HTML,
            Audio::tag()
                ->muted(true)
                ->render(),
            "'muted' must be serialized.",
        );
    }

    #[DataProviderExternal(AudioProvider::class, 'preload')]
    public function testRenderWithPreload(string|Preload $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <audio preload="{$expected}">
            </audio>
            HTML,
            Audio::tag()
                ->preload($value)
                ->render(),
            "'preload' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <audio src="value">
            </audio>
            HTML,
            Audio::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <audio>
            </audio>
            HTML,
            (string) Audio::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $audio = Audio::tag();

        self::assertNotSame(
            $audio,
            $audio->autoplay(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->controls(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->controlslist(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->disableremoteplayback(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->loop(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->muted(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->preload(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $audio,
            $audio->src(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): Audio $setter
     */
    #[DataProviderExternal(AudioProvider::class, 'invalidAttributeValues')]
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
