<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\TextArea;

use UIAwesome\Html\FormControl\TextArea;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testWrapEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must not be empty. The valid values are: "hard", "soft".');

        TextArea::widget()->wrap('');
    }

    public function testWrapInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value "value" for the wrap attribute. Allowed values are: "hard", "soft".');

        TextArea::widget()->wrap('value');
    }
}
