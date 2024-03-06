<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Email;

use UIAwesome\Html\FormControl\Input\Email;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: integer.');

        Email::widget()->value(1)->render();
    }
}
