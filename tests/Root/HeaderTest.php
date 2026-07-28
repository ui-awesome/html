<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Root\Header;

/**
 * Unit tests for {@see Header} rendering and template attribute behavior.
 */
#[Group('root')]
final class HeaderTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            &lt;value&gt;
            </header>
            HTML,
            Header::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <header class="default-class">
            </header>
            HTML,
            Header::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <header>
            </header>
            HTML,
            (string) Header::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
