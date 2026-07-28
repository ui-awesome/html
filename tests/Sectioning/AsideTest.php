<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Sectioning;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Sectioning\Aside;

/**
 * Unit tests for {@see Aside} rendering and template attribute behavior.
 */
#[Group('sectioning')]
final class AsideTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            &lt;value&gt;
            </aside>
            HTML,
            Aside::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <aside class="default-class">
            </aside>
            HTML,
            Aside::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <aside>
            </aside>
            HTML,
            (string) Aside::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
