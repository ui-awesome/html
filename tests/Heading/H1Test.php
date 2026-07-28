<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\H1;

/**
 * Unit tests for {@see H1} rendering and content behavior.
 */
#[Group('heading')]
final class H1Test extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <h1>
            value
            </h1>
            HTML,
            H1::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <h1 class="default-class">
            </h1>
            HTML,
            H1::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <h1>
            </h1>
            HTML,
            (string) H1::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
