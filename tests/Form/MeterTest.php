<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Meter;

/**
 * Unit tests for {@see Meter} rendering and gauge attribute behavior.
 */
#[Group('form')]
final class MeterTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <meter>&lt;value&gt;</meter>
            HTML,
            Meter::tag()
                ->content('<value>')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <meter class="default-class"></meter>
            HTML,
            Meter::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <meter></meter>
            HTML,
            Meter::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithHigh(): void
    {
        self::assertSame(
            <<<HTML
            <meter high="66"></meter>
            HTML,
            Meter::tag()
                ->high(66)
                ->render(),
            "'high' must be serialized.",
        );
    }

    public function testRenderWithLow(): void
    {
        self::assertSame(
            <<<HTML
            <meter low="33"></meter>
            HTML,
            Meter::tag()
                ->low(33)
                ->render(),
            "'low' must be serialized.",
        );
    }

    public function testRenderWithMax(): void
    {
        self::assertSame(
            <<<HTML
            <meter max="100"></meter>
            HTML,
            Meter::tag()
                ->max(100)
                ->render(),
            "'max' must be serialized.",
        );
    }

    public function testRenderWithMin(): void
    {
        self::assertSame(
            <<<HTML
            <meter min="0"></meter>
            HTML,
            Meter::tag()
                ->min(0)
                ->render(),
            "'min' must be serialized.",
        );
    }

    public function testRenderWithOptimum(): void
    {
        self::assertSame(
            <<<HTML
            <meter optimum="80"></meter>
            HTML,
            Meter::tag()
                ->optimum(80)
                ->render(),
            "'optimum' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <meter></meter>
            HTML,
            (string) Meter::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <meter value="50"></meter>
            HTML,
            Meter::tag()
                ->value(50)
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $meter = Meter::tag();

        self::assertNotSame(
            $meter,
            $meter->high(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $meter,
            $meter->low(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $meter,
            $meter->optimum(''),
            'New instance must be returned (immutability).',
        );
    }
}
