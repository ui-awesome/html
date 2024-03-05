<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Checkbox;

use UIAwesome\Html\FormControl\Input\Checkbox;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Checkbox::widget();

        $this->assertNotSame($instance, $instance->enclosedByLabel(false));
    }
}
