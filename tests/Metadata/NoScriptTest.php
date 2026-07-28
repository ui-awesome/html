<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Metadata\NoScript;

/**
 * Unit tests for {@see NoScript} rendering and noscript attribute behavior.
 */
#[Group('metadata')]
final class NoScriptTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            &lt;value&gt;
            </noscript>
            HTML,
            NoScript::tag()->content('<value>')->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript class="default-class">
            </noscript>
            HTML,
            NoScript::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            NoScript::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <noscript>
            </noscript>
            HTML,
            (string) NoScript::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
