<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Flow;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Flow\Main;

/**
 * Unit tests for {@see Main} rendering and content behavior.
 */
#[Group('flow')]
final class MainTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <main>
            value
            </main>
            HTML,
            Main::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <main class="default-class">
            </main>
            HTML,
            Main::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <main>
            </main>
            HTML,
            (string) Main::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
