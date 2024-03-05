<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Textual\A;

use UIAwesome\Html\Textual\A;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testTargetWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The value must not be empty. The valid values are: "_blank", "_self", "_parent", "_top".'
        );

        A::widget()->target('');
    }

    public function testTargetWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "value" for the target attribute. Allowed values are: "_blank", "_self", "_parent", "_top".'
        );

        A::widget()->target('value');
    }
}
