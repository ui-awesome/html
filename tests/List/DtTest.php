<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\Dt;

/**
 * Unit tests for {@see Dt} rendering and content behavior.
 */
#[Group('list')]
final class DtTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            value
            </dt>
            HTML,
            Dt::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <dt class="default-class">
            </dt>
            HTML,
            Dt::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <dt>
            </dt>
            HTML,
            (string) Dt::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
