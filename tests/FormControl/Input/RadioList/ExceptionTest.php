<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use UIAwesome\Html\FormControl\Input\RadioList;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a scalar or null value. The value is: array.');

        RadioList::widget()->checked([])->render();
    }
}
