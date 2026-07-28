<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H3;

/**
 * Unit tests for {@see H3} rendering and content behavior.
 */
#[Group('heading')]
final class H3Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h3>
            value
            </h3>
            HTML,
            H3::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h3 class="default-class">
            </h3>
            HTML,
            H3::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h3>
            </h3>
            HTML,
            (string) H3::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
