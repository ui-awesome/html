<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Checkbox;

use UIAwesome\Html\FormControl\Input\Checkbox;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a scalar or null value. The value is: array.');

        Checkbox::widget()->value([])->render();
    }
}
