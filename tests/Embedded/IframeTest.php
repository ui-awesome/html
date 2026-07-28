<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Loading, Referrerpolicy};
use UIAwesome\Html\Embedded\Iframe;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Embedded\IframeProvider;

/**
 * Unit tests for {@see Iframe} rendering and iframe attribute behavior.
 *
 * {@see IframeProvider} for test case data providers.
 */
#[Group('embedded')]
final class IframeTest extends TestCase
{
    public function testRenderWithAllow(): void
    {
        self::assertSame(
            <<<HTML
            <iframe allow="fullscreen">
            </iframe>
            HTML,
            Iframe::tag()
                ->allow('fullscreen')
                ->render(),
            "'allow' must be serialized.",
        );
    }

    public function testRenderWithAllowfullscreen(): void
    {
        self::assertSame(
            <<<HTML
            <iframe allowfullscreen>
            </iframe>
            HTML,
            Iframe::tag()
                ->allowfullscreen(true)
                ->render(),
            "'allowfullscreen' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <iframe class="default-class">
            </iframe>
            HTML,
            Iframe::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            </iframe>
            HTML,
            Iframe::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <iframe height="150">
            </iframe>
            HTML,
            Iframe::tag()
                ->height(150)
                ->render(),
            "'height' must be serialized.",
        );
    }

    #[DataProviderExternal(IframeProvider::class, 'loading')]
    public function testRenderWithLoading(string|Loading $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <iframe loading="{$expected}">
            </iframe>
            HTML,
            Iframe::tag()
                ->loading($value)
                ->render(),
            "'loading' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <iframe name="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    #[DataProviderExternal(IframeProvider::class, 'referrerpolicy')]
    public function testRenderWithReferrerpolicy(string|Referrerpolicy $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <iframe referrerpolicy="{$expected}">
            </iframe>
            HTML,
            Iframe::tag()
                ->referrerpolicy($value)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithSandbox(): void
    {
        self::assertSame(
            <<<HTML
            <iframe sandbox="allow-scripts">
            </iframe>
            HTML,
            Iframe::tag()
                ->sandbox('allow-scripts')
                ->render(),
            "'sandbox' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <iframe src="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcdoc(): void
    {
        self::assertSame(
            <<<HTML
            <iframe srcdoc="value">
            </iframe>
            HTML,
            Iframe::tag()
                ->srcdoc('value')
                ->render(),
            "'srcdoc' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <iframe>
            </iframe>
            HTML,
            (string) Iframe::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <iframe width="300">
            </iframe>
            HTML,
            Iframe::tag()
                ->width(300)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $iframe = Iframe::tag();

        self::assertNotSame(
            $iframe,
            $iframe->allow(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->allowfullscreen(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->height(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->loading(Loading::LAZY),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->name(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->referrerpolicy(Referrerpolicy::ORIGIN),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->sandbox(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->srcdoc(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $iframe,
            $iframe->width(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): Iframe $setter
     */
    #[DataProviderExternal(IframeProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(
        Closure $setter,
        string $attribute,
        string $allowedValues,
    ): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage('invalid-value', $attribute, $allowedValues),
        );

        $setter();
    }
}
