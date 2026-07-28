<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\Ol;

/**
 * Unit tests for {@see Ol} rendering and ordered list composition behavior.
 */
#[Group('list')]
final class OlTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            value
            </ol>
            HTML,
            Ol::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <ol class="default-class">
            </ol>
            HTML,
            Ol::tag()
                ->attributes(['class' => 'default-class'])
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithItems(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li>
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->items('value')
                ->render(),
            'Items must be appended.',
        );
    }

    public function testRenderWithLi(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li>
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->li('value')
                ->render(),
            'Li entries must be appended.',
        );
    }

    public function testRenderWithLiValue(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            <li value="3">
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->li('value', 3)
                ->render(),
            'Li must accept a value attribute.',
        );
    }

    public function testRenderWithReversed(): void
    {
        self::assertSame(
            <<<HTML
            <ol reversed>
            <li>
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->reversed(true)
                ->li('value')
                ->render(),
            "'reversed' must be serialized.",
        );
    }

    public function testRenderWithStart(): void
    {
        self::assertSame(
            <<<HTML
            <ol start="5">
            <li>
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->li('value')
                ->start(5)
                ->render(),
            "'start' must be serialized.",
        );
    }

    public function testRenderWithStartAndReversed(): void
    {
        self::assertSame(
            <<<HTML
            <ol reversed start="10">
            <li>
            value
            </li>
            </ol>
            HTML,
            Ol::tag()
                ->li('value')
                ->reversed(true)
                ->start(10)
                ->render(),
            'start and reversed must be serialized together.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <ol>
            </ol>
            HTML,
            Ol::tag()->render(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $ol = Ol::tag();

        self::assertNotSame(
            $ol,
            $ol->items(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $ol,
            $ol->li(''),
            'New instance must be returned (immutability).',
        );
    }
}
