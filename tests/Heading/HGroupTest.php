<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Heading;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Heading\HGroup;

/**
 * Unit tests for {@see HGroup} rendering and content behavior.
 */
#[Group('heading')]
final class HGroupTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <hgroup>
            value
            </hgroup>
            HTML,
            HGroup::tag()->content('value')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <hgroup class="default-class">
            </hgroup>
            HTML,
            HGroup::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <hgroup>
            </hgroup>
            HTML,
            (string) HGroup::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
