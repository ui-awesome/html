<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\InputWeek;

/**
 * Unit tests for {@see InputWeek} rendering and attribute behavior.
 */
#[Group('form')]
final class InputWeekTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputweek" type="week">
            HTML,
            InputWeek::tag(['class' => 'default-class'])->id('inputweek')->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputweek" type="week">
            HTML,
            InputWeek::tag()->id('inputweek')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="week">
            HTML,
            (string) InputWeek::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
