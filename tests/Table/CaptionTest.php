<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Table;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Table\Caption;

/**
 * Unit tests for {@see Caption} rendering and template attribute behavior.
 */
#[Group('table')]
final class CaptionTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <caption>
            value
            </caption>
            HTML,
            Caption::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <caption class="default-class">
            </caption>
            HTML,
            Caption::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <caption>
            </caption>
            HTML,
            (string) Caption::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
