<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Text;

use UIAwesome\Html\FormControl\Input\Text;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a string or null value. The value is: array.');

        Text::widget()->value([])->render();
    }
}
