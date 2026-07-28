<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Phrasing\Code;

/**
 * Identity tests for {@see Code}: tag shape, constructor configuration, and string casting.
 */
#[Group('phrasing')]
final class CodeTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <code>&lt;value&gt;</code>
            HTML,
            Code::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <code class="default-class"></code>
            HTML,
            Code::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <code></code>
            HTML,
            Code::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <code></code>
            HTML,
            (string) Code::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
