<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Option;

/**
 * Unit tests for {@see Option} rendering and option attribute behavior.
 */
#[Group('form')]
final class OptionTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <option>
            Santiago
            </option>
            HTML,
            Option::tag()->content('Santiago')->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <option class="default-class">
            </option>
            HTML,
            Option::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <option disabled>
            </option>
            HTML,
            Option::tag()->disabled(true)->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <option label="Santiago">
            </option>
            HTML,
            Option::tag()->label('Santiago')->render(),
            "'label' must be serialized.",
        );
    }

    public function testRenderWithSelected(): void
    {
        self::assertSame(
            <<<HTML
            <option selected>
            </option>
            HTML,
            Option::tag()->selected(true)->render(),
            "'selected' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <option>
            </option>
            HTML,
            (string) Option::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <option value="1">
            </option>
            HTML,
            Option::tag()->value(1)->render(),
            "'value' must be serialized.",
        );
    }
}
