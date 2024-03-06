<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Range;

use UIAwesome\Html\FormControl\Input\Range;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a numeric or null value. The value is: array.');

        Range::widget()->value([])->render();
    }
}
