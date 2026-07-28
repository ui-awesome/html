<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Blocking, Crossorigin, Fetchpriority, Referrerpolicy};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Script;
use UIAwesome\Html\Tests\Provider\Metadata\ScriptProvider;

/**
 * Unit tests for {@see Script} rendering and script attribute behavior.
 *
 * {@see ScriptProvider} for test case data providers.
 */
#[Group('metadata')]
final class ScriptTest extends TestCase
{
    public function testRenderWithAsync(): void
    {
        self::assertSame(
            <<<HTML
            <script async>
            </script>
            HTML,
            Script::tag()->async(true)->render(),
            "'async' must be serialized.",
        );
    }

    #[DataProviderExternal(ScriptProvider::class, 'blocking')]
    public function testRenderWithBlocking(string|Blocking $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <script blocking="{$expected}">
            </script>
            HTML,
            Script::tag()->blocking($value)->render(),
            "'blocking' must be serialized.",
        );
    }

    #[DataProviderExternal(ScriptProvider::class, 'crossorigin')]
    public function testRenderWithCrossorigin(string|Crossorigin $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <script crossorigin="{$expected}">
            </script>
            HTML,
            Script::tag()->crossorigin($value)->render(),
            "'crossorigin' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <script class="default-class">
            </script>
            HTML,
            Script::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            Script::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefer(): void
    {
        self::assertSame(
            <<<HTML
            <script defer>
            </script>
            HTML,
            Script::tag()->defer(true)->render(),
            "'defer' must be serialized.",
        );
    }

    #[DataProviderExternal(ScriptProvider::class, 'fetchpriority')]
    public function testRenderWithFetchpriority(string|Fetchpriority $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <script fetchpriority="{$expected}">
            </script>
            HTML,
            Script::tag()->fetchpriority($value)->render(),
            "'fetchpriority' must be serialized.",
        );
    }

    public function testRenderWithIntegrity(): void
    {
        self::assertSame(
            <<<HTML
            <script integrity="value">
            </script>
            HTML,
            Script::tag()->integrity('value')->render(),
            "'integrity' must be serialized.",
        );
    }

    public function testRenderWithNomodule(): void
    {
        self::assertSame(
            <<<HTML
            <script nomodule>
            </script>
            HTML,
            Script::tag()->nomodule(true)->render(),
            "'nomodule' must be serialized.",
        );
    }

    #[DataProviderExternal(ScriptProvider::class, 'referrerpolicy')]
    public function testRenderWithReferrerpolicy(string|Referrerpolicy $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <script referrerpolicy="{$expected}">
            </script>
            HTML,
            Script::tag()->referrerpolicy($value)->render(),
            "'referrerpolicy' must be serialized.",
        );
    }

    public function testRenderWithSrc(): void
    {
        self::assertSame(
            <<<HTML
            <script src="value">
            </script>
            HTML,
            Script::tag()->src('value')->render(),
            "'src' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            (string) Script::tag(),
            'Casting to string must produce HTML.',
        );
    }

    #[DataProviderExternal(ScriptProvider::class, 'type')]
    public function testRenderWithType(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <script type="{$expected}">
            </script>
            HTML,
            Script::tag()->type($value)->render(),
            "'type' must be serialized.",
        );
    }

    public function testRenderWithTypeNull(): void
    {
        self::assertSame(
            <<<HTML
            <script>
            </script>
            HTML,
            Script::tag()->type('module')->type(null)->render(),
            '`null` must remove the attribute.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $script = Script::tag();

        self::assertNotSame(
            $script,
            $script->async(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->blocking(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->crossorigin(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->defer(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->fetchpriority(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->integrity(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->nomodule(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->referrerpolicy(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->src(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $script,
            $script->type(''),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): Script $setter
     */
    #[DataProviderExternal(ScriptProvider::class, 'invalidAttributeValues')]
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
