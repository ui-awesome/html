<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Root\Head;

/**
 * Unit tests for {@see Head} rendering and template attribute behavior.
 */
#[Group('root')]
final class HeadTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <head>
            &lt;value&gt;
            </head>
            HTML,
            Head::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <head class="default-class">
            </head>
            HTML,
            Head::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <head>
            </head>
            HTML,
            (string) Head::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
