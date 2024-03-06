<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Select;

use UIAwesome\Html\FormControl\Select;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Select::widget();

        $this->assertNotSame($instance, $instance->groups([]));
        $this->assertNotSame($instance, $instance->items([]));
        $this->assertNotSame($instance, $instance->itemsAttributes([]));
        $this->assertNotSame($instance, $instance->prompt(''));
    }
}
