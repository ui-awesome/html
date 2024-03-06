<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\ButtonGroup;

use UIAwesome\Html\FormControl\Input\{Button, ButtonGroup};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = ButtonGroup::widget();

        $this->assertNotSame($instance, $instance->buttons(Button::widget()));
        $this->assertNotSame($instance, $instance->individualContainer(false));
    }
}
