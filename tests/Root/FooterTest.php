<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Root\Footer;

/**
 * Unit tests for {@see Footer} rendering and template attribute behavior.
 */
#[Group('root')]
final class FooterTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <footer>
            &lt;value&gt;
            </footer>
            HTML,
            Footer::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <footer class="default-class">
            </footer>
            HTML,
            Footer::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <footer>
            </footer>
            HTML,
            (string) Footer::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
