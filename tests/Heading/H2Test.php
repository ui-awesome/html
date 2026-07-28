<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H2;

/**
 * Unit tests for {@see H2} rendering and content behavior.
 */
#[Group('heading')]
final class H2Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h2>
            value
            </h2>
            HTML,
            H2::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h2 class="default-class">
            </h2>
            HTML,
            H2::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h2>
            </h2>
            HTML,
            (string) H2::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
