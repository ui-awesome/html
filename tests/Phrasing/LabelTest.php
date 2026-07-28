<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Phrasing\Label;

/**
 * Unit tests for {@see Label} rendering and the `for` attribute.
 */
#[Group('phrasing')]
final class LabelTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <label>value</label>
            HTML,
            Label::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <label class="default-class"></label>
            HTML,
            Label::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <label></label>
            HTML,
            Label::tag()->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithFor(): void
    {
        self::assertSame(
            <<<HTML
            <label for="value"></label>
            HTML,
            Label::tag()
                ->for('value')
                ->render(),
            "'for' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <label></label>
            HTML,
            (string) Label::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
