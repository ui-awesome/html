<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Phrasing\I;

/**
 * Identity tests for {@see I}: tag shape, constructor configuration, and string casting.
 */
#[Group('phrasing')]
final class ITest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <i>&lt;value&gt;</i>
            HTML,
            I::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <i class="default-class"></i>
            HTML,
            I::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <i></i>
            HTML,
            I::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <i></i>
            HTML,
            (string) I::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
