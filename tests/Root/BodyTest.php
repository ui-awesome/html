<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Root;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Root\Body;

/**
 * Unit tests for {@see Body} rendering and template attribute behavior.
 */
#[Group('root')]
final class BodyTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <body>
            &lt;value&gt;
            </body>
            HTML,
            Body::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <body class="default-class">
            </body>
            HTML,
            Body::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <body>
            </body>
            HTML,
            (string) Body::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
