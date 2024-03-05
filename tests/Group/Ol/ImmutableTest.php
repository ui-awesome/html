<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Ol;

use UIAwesome\Html\Group\Ol;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Ol::widget();

        $this->assertNotSame($instance, $instance->content());
        $this->assertNotSame($instance, $instance->reversed());
        $this->assertNotSame($instance, $instance->start(1));
    }
}
