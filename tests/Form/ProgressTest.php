<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Progress;

/**
 * Unit tests for {@see Progress} rendering and progress attribute behavior.
 */
#[Group('form')]
final class ProgressTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <progress>&lt;value&gt;</progress>
            HTML,
            Progress::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <progress class="default-class"></progress>
            HTML,
            Progress::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <progress></progress>
            HTML,
            Progress::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <progress max="100"></progress>
            HTML,
            Progress::tag()
                ->max(100)
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <progress></progress>
            HTML,
            (string) Progress::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <progress value="70"></progress>
            HTML,
            Progress::tag()
                ->value(70)
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testRenderWithValueAndMax(): void
    {
        self::assertSame(
            <<<HTML
            <progress value="70" max="100"></progress>
            HTML,
            Progress::tag()
                ->value(70)
                ->max(100)
                ->render(),
            'value and max must be serialized together.',
        );
    }
}
