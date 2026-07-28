<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H6;

/**
 * Unit tests for {@see H6} rendering and content behavior.
 */
#[Group('heading')]
final class H6Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            value
            </h6>
            HTML,
            H6::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h6 class="default-class">
            </h6>
            HTML,
            H6::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h6>
            </h6>
            HTML,
            (string) H6::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
