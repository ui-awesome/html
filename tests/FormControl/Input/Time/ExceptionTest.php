<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Time;

use UIAwesome\Html\FormControl\Input\Time;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: array.');

        Time::widget()->value([])->render();
    }
}
