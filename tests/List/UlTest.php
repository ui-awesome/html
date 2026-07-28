<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\List;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\List\Ul;

/**
 * Unit tests for {@see Ul} rendering and unordered list composition behavior.
 */
#[Group('list')]
final class UlTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            value
            </ul>
            HTML,
            Ul::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <ul class="default-class">
            </ul>
            HTML,
            Ul::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithItems(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li>
            value
            </li>
            </ul>
            HTML,
            Ul::tag()
                ->items('value')
                ->render(),
            'Items must be appended.',
        );
    }

    public function testRenderWithLi(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li>
            value
            </li>
            </ul>
            HTML,
            Ul::tag()
                ->li('value')
                ->render(),
            'Li entries must be appended.',
        );
    }

    public function testRenderWithLiValue(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li value="3">
            value
            </li>
            </ul>
            HTML,
            Ul::tag()
                ->li('value', 3)
                ->render(),
            'Li must accept a value attribute.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            </ul>
            HTML,
            (string) Ul::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $ul = Ul::tag();

        self::assertNotSame(
            $ul,
            $ul->items(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $ul,
            $ul->li(''),
            'New instance must be returned (immutability).',
        );
    }
}
