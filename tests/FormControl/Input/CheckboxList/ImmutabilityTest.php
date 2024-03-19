<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use UIAwesome\Html\FormControl\Input\{Checkbox, CheckboxList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = CheckboxList::widget();

        $this->assertNotSame($instance, $instance->enclosedByLabel(false));
        $this->assertNotSame($instance, $instance->items(Checkbox::widget()));
        $this->assertNotSame($instance, $instance->labelItemClass(''));
    }
}
