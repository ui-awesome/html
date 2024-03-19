<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use UIAwesome\Html\FormControl\Input\CheckboxList;

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
        $this->expectExceptionMessage('The value must be an iterable or null value. The value is: integer.');

        CheckboxList::widget()->checked(1)->render();
    }
}
