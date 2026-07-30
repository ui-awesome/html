<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Embedded;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Crossorigin, Decoding, Fetchpriority, Loading, Referrerpolicy};
use UIAwesome\Html\Embedded\Img;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Embedded\ImgProvider;

/**
 * Unit tests for {@see Img} rendering and image attribute behavior.
 *
 * {@see ImgProvider} for test case data providers.
 */
#[Group('embedded')]
final class ImgTest extends TestCase
{
    public function testRenderWithAlt(): void
    {
        self::assertSame(
            <<<HTML
            <img alt="value">
            HTML,
            Img::tag()
                ->alt('value')
                ->render(),
            "'alt' must be serialized.",
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'crossorigin')]
    public function testRenderWithCrossorigin(string|Crossorigin $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <img crossorigin="{$expected}">
            HTML,
            Img::tag()
                ->crossorigin($value)
                ->render(),
            "'crossorigin' must be serialized.",
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'decoding')]
    public function testRenderWithDecoding(string|Decoding $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <img decoding="{$expected}">
            HTML,
            Img::tag()
                ->decoding($value)
                ->render(),
            "'decoding' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <img class="default-class">
            HTML,
            Img::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <img>
            HTML,
            Img::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithElementtiming(): void
    {
        self::assertSame(
            <<<HTML
            <img elementtiming="value">
            HTML,
            Img::tag()
                ->elementtiming('value')
                ->render(),
            "'elementtiming' must be serialized.",
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'fetchpriority')]
    public function testRenderWithFetchpriority(string|Fetchpriority $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <img fetchpriority="{$expected}">
            HTML,
            Img::tag()
                ->fetchpriority($value)
                ->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithHeight(): void
    {
        self::assertSame(
            <<<HTML
            <img height="600">
            HTML,
            Img::tag()
                ->height(600)
                ->render(),
            "'height' must be serialized.",
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'ismap')]
    public function testRenderWithIsmap(bool $value, string $expected): void
    {
        self::assertSame(
            $expected,
            Img::tag()
                ->ismap($value)
                ->render(),
            'Boolean attribute must render only when `true`.',
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'loading')]
    public function testRenderWithLoading(string|Loading $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <img loading="{$expected}">
            HTML,
            Img::tag()
                ->loading($value)
                ->render(),
            "'loading' must be serialized.",
        );
    }

    #[DataProviderExternal(ImgProvider::class, 'referrerpolicy')]
    public function testRenderWithReferrerpolicy(string|Referrerpolicy $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <img referrerpolicy="{$expected}">
            HTML,
            Img::tag()
                ->referrerpolicy($value)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <img sizes="(max-width: 600px) 100vw, 50vw">
            HTML,
            Img::tag()
                ->sizes('(max-width: 600px) 100vw, 50vw')
                ->render(),
            "'sizes' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <img src="value">
            HTML,
            Img::tag()
                ->src('value')
                ->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithSrcset(): void
    {
        self::assertSame(
            <<<HTML
            <img srcset="image-320w.jpg 320w, image-480w.jpg 480w">
            HTML,
            Img::tag()
                ->srcset('image-320w.jpg 320w, image-480w.jpg 480w')
                ->render(),
            "'srcset' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<img>',
            (string) Img::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithUsemap(): void
    {
        self::assertSame(
            <<<HTML
            <img usemap="#map">
            HTML,
            Img::tag()
                ->usemap('#map')
                ->render(),
            "'usemap' must be serialized.",
        );
    }

    public function testRenderWithWidth(): void
    {
        self::assertSame(
            <<<HTML
            <img width="800">
            HTML,
            Img::tag()
                ->width(800)
                ->render(),
            "'width' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $img = Img::tag();

        self::assertNotSame(
            $img,
            $img->alt(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->decoding(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->elementtiming(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->fetchpriority(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->height(null),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->ismap(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->loading(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->sizes(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->srcset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->usemap(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $img,
            $img->width(null),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Img $setter
     */
    #[DataProviderExternal(ImgProvider::class, 'invalidAttributeValues')]
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
