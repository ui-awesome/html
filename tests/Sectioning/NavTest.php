<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Sectioning;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Sectioning\Nav;

/**
 * Unit tests for {@see Nav} rendering and template attribute behavior.
 */
#[Group('sectioning')]
final class NavTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            &lt;value&gt;
            </nav>
            HTML,
            Nav::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="default-class">
            </nav>
            HTML,
            Nav::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            </nav>
            HTML,
            (string) Nav::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
