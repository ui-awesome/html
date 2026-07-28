<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H5;

/**
 * Unit tests for {@see H5} rendering and content behavior.
 */
#[Group('heading')]
final class H5Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h5>
            value
            </h5>
            HTML,
            H5::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h5 class="default-class">
            </h5>
            HTML,
            H5::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h5>
            </h5>
            HTML,
            (string) H5::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
