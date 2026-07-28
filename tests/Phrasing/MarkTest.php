<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Phrasing\Mark;

/**
 * Identity tests for {@see Mark}: tag shape, constructor configuration, and string casting.
 */
#[Group('phrasing')]
final class MarkTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <mark>&lt;value&gt;</mark>
            HTML,
            Mark::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <mark class="default-class"></mark>
            HTML,
            Mark::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <mark></mark>
            HTML,
            Mark::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <mark></mark>
            HTML,
            (string) Mark::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
