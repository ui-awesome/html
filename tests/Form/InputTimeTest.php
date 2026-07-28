<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\InputTime;

/**
 * Unit tests for {@see InputTime} rendering and attribute behavior.
 */
#[Group('form')]
final class InputTimeTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtime" type="time">
            HTML,
            InputTime::tag(['class' => 'default-class'])
                ->id('inputtime')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtime" type="time">
            HTML,
            InputTime::tag()
                ->id('inputtime')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="time">
            HTML,
            (string) InputTime::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
