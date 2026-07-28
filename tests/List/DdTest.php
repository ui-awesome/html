<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\Dd;

/**
 * Unit tests for {@see Dd} rendering and content behavior.
 */
#[Group('list')]
final class DdTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dd>
            value
            </dd>
            HTML,
            Dd::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dd class="default-class">
            </dd>
            HTML,
            Dd::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dd>
            </dd>
            HTML,
            (string) Dd::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
