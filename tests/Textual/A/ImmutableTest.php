<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\A;

use UIAwesome\Html\Textual\A;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = A::widget();

        $this->assertNotSame($instance, $instance->download());
        $this->assertNotSame($instance, $instance->href(''));
        $this->assertNotSame($instance, $instance->hreflang(''));
        $this->assertNotSame($instance, $instance->ping(''));
        $this->assertNotSame($instance, $instance->target('_blank'));
    }
}
