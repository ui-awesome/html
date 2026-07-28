<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Phrasing\Em;

/**
 * Identity tests for {@see Em}: tag shape, constructor configuration, and string casting.
 */
#[Group('phrasing')]
final class EmTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <em>&lt;value&gt;</em>
            HTML,
            Em::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <em class="default-class"></em>
            HTML,
            Em::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <em></em>
            HTML,
            Em::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <em></em>
            HTML,
            (string) Em::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
