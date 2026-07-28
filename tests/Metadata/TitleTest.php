<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Metadata\Title;

/**
 * Unit tests for {@see Title} rendering and title attribute behavior.
 */
#[Group('metadata')]
final class TitleTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <title>
            &lt;value&gt;
            </title>
            HTML,
            Title::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <title class="default-class">
            </title>
            HTML,
            Title::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <title>
            </title>
            HTML,
            Title::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <title>
            </title>
            HTML,
            (string) Title::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
