<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{AsValue, Blocking, Crossorigin, Fetchpriority, Referrerpolicy, Rel};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Link;
use UIAwesome\Html\Tests\Provider\Metadata\LinkProvider;

/**
 * Unit tests for {@see Link} rendering and link attribute behavior.
 *
 * {@see LinkProvider} for test case data providers.
 */
#[Group('metadata')]
final class LinkTest extends TestCase
{
    #[DataProviderExternal(LinkProvider::class, 'as')]
    public function testRenderWithAs(string|AsValue $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link as="{$expected}">
            HTML,
            Link::tag()->as($value)->render(),
            "'as' must be serialized.",
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'blocking')]
    public function testRenderWithBlocking(string|Blocking $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link blocking="{$expected}">
            HTML,
            Link::tag()->blocking($value)->render(),
            "'blocking' must be serialized.",
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'crossorigin')]
    public function testRenderWithCrossorigin(string|Crossorigin $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link crossorigin="{$expected}">
            HTML,
            Link::tag()->crossorigin($value)->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <link class="default-class">
            HTML,
            Link::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <link>
            HTML,
            Link::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <link disabled>
            HTML,
            Link::tag()->disabled(true)->render(),
            "'disabled' must be serialized.",
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'fetchpriority')]
    public function testRenderWithFetchpriority(string|Fetchpriority $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link fetchpriority="{$expected}">
            HTML,
            Link::tag()->fetchpriority($value)->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <link href="value">
            HTML,
            Link::tag()->href('value')->render(),
            "'href' must be serialized.",
        );
    }

    public function testRenderWithHreflang(): void
    {
        self::assertSame(
            <<<HTML
            <link hreflang="en">
            HTML,
            Link::tag()->hreflang('en')->render(),
            "'hreflang' must be serialized.",
        );
    }

    public function testRenderWithImagesizes(): void
    {
        self::assertSame(
            <<<HTML
            <link imagesizes="100vw">
            HTML,
            Link::tag()->imagesizes('100vw')->render(),
            "'imagesizes' must be serialized.",
        );
    }

    public function testRenderWithImagesrcset(): void
    {
        self::assertSame(
            <<<HTML
            <link imagesrcset="image-480.jpg 480w, image-800.jpg 800w">
            HTML,
            Link::tag()->imagesrcset('image-480.jpg 480w, image-800.jpg 800w')->render(),
            "'imagesrcset' must be serialized.",
        );
    }

    public function testRenderWithIntegrity(): void
    {
        self::assertSame(
            <<<HTML
            <link integrity="value">
            HTML,
            Link::tag()->integrity('value')->render(),
            "'integrity' must be serialized.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <link media="screen and (min-width: 768px)">
            HTML,
            Link::tag()->media('screen and (min-width: 768px)')->render(),
            "'media' must be serialized.",
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'referrerpolicy')]
    public function testRenderWithReferrerpolicy(string|Referrerpolicy $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link referrerpolicy="{$expected}">
            HTML,
            Link::tag()->referrerpolicy($value)->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'rel')]
    public function testRenderWithRel(string|Rel $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link rel="{$expected}">
            HTML,
            Link::tag()->rel($value)->render(),
            "'rel' must be serialized.",
        );
    }

    public function testRenderWithSizes(): void
    {
        self::assertSame(
            <<<HTML
            <link sizes="16x16">
            HTML,
            Link::tag()->sizes('16x16')->render(),
            "'sizes' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<link>',
            (string) Link::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(LinkProvider::class, 'type')]
    public function testRenderWithType(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <link type="{$expected}">
            HTML,
            Link::tag()->type($value)->render(),
            "'type' must be serialized.",
        );
    }

    /**
     * @phpstan-param Closure(): Link $setter
     */
    #[DataProviderExternal(LinkProvider::class, 'invalidAttributeValues')]
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
