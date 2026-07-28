<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\Li;

/**
 * Unit tests for {@see Li} rendering and content behavior.
 */
#[Group('list')]
final class LiTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <li class="default-class">
            </li>
            HTML,
            Li::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithoutValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            value
            </li>
            HTML,
            Li::tag()->content('value')->render(),
            'Content must be rendered correctly.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            </li>
            HTML,
            (string) Li::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <li value="3">
            </li>
            HTML,
            Li::tag()->value(3)->render(),
            "'value' must be serialized.",
        );
    }
}
