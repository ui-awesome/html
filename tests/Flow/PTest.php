<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Flow;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Flow\P;

/**
 * Unit tests for {@see P} rendering and content behavior.
 */
#[Group('flow')]
final class PTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <p>
            value
            </p>
            HTML,
            P::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <p class="default-class">
            </p>
            HTML,
            P::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <p>
            </p>
            HTML,
            (string) P::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
