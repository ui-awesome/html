<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Output;

/**
 * Unit tests for {@see Output} rendering and calculation result behavior.
 */
#[Group('form')]
final class OutputTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <output>value</output>
            HTML,
            Output::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <output class="default-class"></output>
            HTML,
            Output::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <output></output>
            HTML,
            Output::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithFor(): void
    {
        self::assertSame(
            <<<HTML
            <output for="price quantity"></output>
            HTML,
            Output::tag()
                ->for('price quantity')
                ->render(),
            "'for' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <output form="order-form"></output>
            HTML,
            Output::tag()
                ->form('order-form')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <output name="total"></output>
            HTML,
            Output::tag()
                ->name('total')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <output></output>
            HTML,
            (string) Output::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
