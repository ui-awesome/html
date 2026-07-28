<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\InputDateTimeLocal;

/**
 * Unit tests for {@see InputDateTimeLocal} rendering and attribute behavior.
 */
#[Group('form')]
final class InputDateTimeLocalTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag(['class' => 'default-class'])->id('inputdatetimelocal')->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputdatetimelocal" type="datetime-local">
            HTML,
            InputDateTimeLocal::tag()->id('inputdatetimelocal')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="datetime-local">
            HTML,
            (string) InputDateTimeLocal::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
