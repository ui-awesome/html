<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Metadata\Template;
use UIAwesome\Html\Metadata\Values\ShadowRootMode;
use UIAwesome\Html\Tests\Provider\Metadata\TemplateProvider;

use function implode;

/**
 * Unit tests for {@see Template} rendering and template attribute behavior.
 *
 * {@see TemplateProvider} for test case data providers.
 */
#[Group('metadata')]
final class TemplateTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <template class="default-class">
            </template>
            HTML,
            Template::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            </template>
            HTML,
            Template::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithShadowRootClonable(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootclonable>
            </template>
            HTML,
            Template::tag()->shadowRootClonable(true)->render(),
            "'shadowrootclonable' must be serialized.",
        );
    }

    public function testRenderWithShadowRootDelegatesFocus(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootdelegatesfocus>
            </template>
            HTML,
            Template::tag()->shadowRootDelegatesFocus(true)->render(),
            "'shadowrootdelegatesfocus' must be serialized.",
        );
    }

    #[DataProviderExternal(TemplateProvider::class, 'shadowRootMode')]
    public function testRenderWithShadowRootMode(string|ShadowRootMode $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootmode="{$expected}">
            </template>
            HTML,
            Template::tag()->shadowRootMode($value)->render(),
            "'shadowrootmode' must be serialized.",
        );
    }

    public function testRenderWithShadowRootReferenceTarget(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootreferencetarget="value">
            </template>
            HTML,
            Template::tag()->shadowRootReferenceTarget('value')->render(),
            "'shadowrootreferencetarget' must be serialized.",
        );
    }

    public function testRenderWithShadowRootSerializable(): void
    {
        self::assertSame(
            <<<HTML
            <template shadowrootserializable>
            </template>
            HTML,
            Template::tag()->shadowRootSerializable(true)->render(),
            "'shadowrootserializable' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <template>
            </template>
            HTML,
            (string) Template::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $template = Template::tag();

        self::assertNotSame(
            $template,
            $template->shadowRootClonable(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootDelegatesFocus(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootMode(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootReferenceTarget(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $template,
            $template->shadowRootSerializable(true),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingShadowRootMode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'invalid-value',
                'shadowrootmode',
                implode("', '", Enum::normalizeStringArray(ShadowRootMode::cases())),
            ),
        );

        Template::tag()->shadowRootMode('invalid-value');
    }
}
