<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Interactive;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Interactive\Summary;

/**
 * Unit tests for {@see Summary} rendering and content behavior.
 */
#[Group('interactive')]
final class SummaryTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <summary>
            value
            </summary>
            HTML,
            Summary::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <summary class="default-class">
            </summary>
            HTML,
            Summary::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <summary>
            </summary>
            HTML,
            (string) Summary::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
