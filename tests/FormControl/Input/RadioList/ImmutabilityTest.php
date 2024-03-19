<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use UIAwesome\Html\FormControl\Input\{Radio, RadioList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = RadioList::widget();

        $this->assertNotSame($instance, $instance->enclosedByLabel(false));
        $this->assertNotSame($instance, $instance->items(Radio::widget()));
        $this->assertNotSame($instance, $instance->labelItemClass(''));
    }
}
