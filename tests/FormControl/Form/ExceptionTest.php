<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl;

use UIAwesome\Html\FormControl\Form;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testEnctypeWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The value must not be empty. The valid values are: "multipart/form-data", "application/x-www-form-urlencoded", "text/plain".'
        );

        Form::widget()->enctype('')->render();
    }

    public function testEnctypeWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "value" for the enctype attribute. Allowed values are: "multipart/form-data", "application/x-www-form-urlencoded", "text/plain".'
        );

        Form::widget()->enctype('value')->render();
    }
}
