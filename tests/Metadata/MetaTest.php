<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Charset, ElementAttribute, HttpEquiv};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Meta;
use UIAwesome\Html\Tests\Provider\Metadata\MetaProvider;

use function implode;

/**
 * Unit tests for {@see Meta} rendering and meta attribute behavior.
 *
 * {@see MetaProvider} for test case data providers.
 */
#[Group('metadata')]
final class MetaTest extends TestCase
{
    #[DataProviderExternal(MetaProvider::class, 'charset')]
    public function testRenderWithCharset(string|Charset $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <meta charset="{$expected}">
            HTML,
            Meta::tag()->charset($value)->render(),
            "'charset' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <meta content="value">
            HTML,
            Meta::tag()->content('value')->render(),
            "'content' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <meta class="default-class">
            HTML,
            Meta::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <meta>
            HTML,
            Meta::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    #[DataProviderExternal(MetaProvider::class, 'httpEquiv')]
    public function testRenderWithHttpEquiv(string|HttpEquiv $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <meta http-equiv="{$expected}">
            HTML,
            Meta::tag()->httpEquiv($value)->render(),
            "'http-equiv' must be serialized.",
        );
    }

    public function testRenderWithMedia(): void
    {
        self::assertSame(
            <<<HTML
            <meta media="value">
            HTML,
            Meta::tag()->media('value')->render(),
            "'media' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <meta name="value">
            HTML,
            Meta::tag()->name('value')->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            '<meta>',
            (string) Meta::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingHttpEquiv(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                ElementAttribute::HTTP_EQUIV->value,
                implode("', '", Enum::normalizeStringArray(HttpEquiv::cases())),
            ),
        );

        Meta::tag()->httpEquiv('invalid-value');
    }
}
