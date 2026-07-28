<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Legend;

/**
 * Unit tests for {@see Legend} rendering and attribute behavior.
 */
#[Group('form')]
final class LegendTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <legend>
            value
            </legend>
            HTML,
            Legend::tag()
                ->content('value')
                ->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <legend class="default-class">
            </legend>
            HTML,
            Legend::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <legend>
            </legend>
            HTML,
            (string) Legend::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
