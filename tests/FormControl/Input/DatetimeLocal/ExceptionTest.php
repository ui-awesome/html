<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\DatetimeLocal;

use UIAwesome\Html\FormControl\Input\DatetimeLocal;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: array.');

        DatetimeLocal::widget()->value([])->render();
    }
}
