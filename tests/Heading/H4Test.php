<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H4;

/**
 * Unit tests for {@see H4} rendering and content behavior.
 */
#[Group('heading')]
final class H4Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h4>
            value
            </h4>
            HTML,
            H4::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h4 class="default-class">
            </h4>
            HTML,
            H4::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h4>
            </h4>
            HTML,
            (string) H4::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
