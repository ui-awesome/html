<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\InputDate;

/**
 * Unit tests for {@see InputDate} rendering and attribute behavior.
 */
#[Group('form')]
final class InputDateTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdate" type="date">
            HTML,
            InputDate::tag(['class' => 'default-class'])->id('inputdate')->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdate" type="date">
            HTML,
            InputDate::tag()->id('inputdate')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="date">
            HTML,
            (string) InputDate::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
