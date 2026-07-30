<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Palpable;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Language, Referrerpolicy, Rel, Target};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Palpable\A;
use UIAwesome\Html\Tests\Provider\Palpable\AProvider;

/**
 * Unit tests for {@see A} rendering and anchor attribute behavior.
 *
 * {@see AProvider} for test case data providers.
 */
#[Group('palpable')]
final class ATest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <a>&lt;value&gt;</a>
            HTML,
            A::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <a class="default-class"></a>
            HTML,
            A::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[TestWith([true, 'download'], 'boolean')]
    #[TestWith(['file.pdf', 'download="file.pdf"'], 'filename')]
    public function testRenderWithDownload(bool|string $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <a {$expected}></a>
            HTML,
            A::tag()
                ->download($value)
                ->render(),
            "'download' must be serialized.",
        );
    }

    public function testRenderWithHref(): void
    {
        self::assertSame(
            <<<HTML
            <a href="https://example.com"></a>
            HTML,
            A::tag()
                ->href('https://example.com')
                ->render(),
            "'href' must be serialized.",
        );
    }

    #[TestWith(['en'], 'string')]
    #[TestWith([Language::ENGLISH], 'enum')]
    public function testRenderWithHreflang(string|Language $value): void
    {
        self::assertSame(
            <<<HTML
            <a hreflang="en"></a>
            HTML,
            A::tag()
                ->hreflang($value)
                ->render(),
            "'hreflang' must be serialized.",
        );
    }

    public function testRenderWithPing(): void
    {
        self::assertSame(
            <<<HTML
            <a ping="https://example.com/track"></a>
            HTML,
            A::tag()
                ->ping('https://example.com/track')
                ->render(),
            "'ping' must be serialized.",
        );
    }

    #[DataProviderExternal(AProvider::class, 'referrerpolicy')]
    public function testRenderWithReferrerpolicy(string|Referrerpolicy $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <a referrerpolicy="{$expected}"></a>
            HTML,
            A::tag()
                ->referrerpolicy($value)
                ->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    #[DataProviderExternal(AProvider::class, 'rel')]
    public function testRenderWithRel(string|Rel $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <a rel="{$expected}"></a>
            HTML,
            A::tag()
                ->rel($value)
                ->render(),
            "'rel' must be serialized.",
        );
    }

    #[DataProviderExternal(AProvider::class, 'target')]
    public function testRenderWithTarget(string|Target $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <a target="{$expected}"></a>
            HTML,
            A::tag()
                ->target($value)
                ->render(),
            "'target' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            (string) A::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(AProvider::class, 'type')]
    public function testRenderWithType(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <a type="{$expected}"></a>
            HTML,
            A::tag()
                ->type($value)
                ->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeNull(): void
    {
        self::assertSame(
            <<<HTML
            <a></a>
            HTML,
            A::tag()
                ->type('application/pdf')
                ->type(null)
                ->render(),
            '`null` must remove the attribute.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $a = A::tag();

        self::assertNotSame(
            $a,
            $a->download(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->href(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->hreflang(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->ping(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->rel(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->target(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $a,
            $a->type(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): A $setter
     */
    #[DataProviderExternal(AProvider::class, 'invalidAttributeValues')]
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
