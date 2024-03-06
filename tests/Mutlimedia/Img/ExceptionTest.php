<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Mutlimedia\Img;

use UIAwesome\Html\Multimedia\Img;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCrossoriginWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The value must not be empty. The valid values are: "anonymous", "use-credentials".'
        );

        Img::widget()->crossorigin('');
    }

    public function testCrossoriginWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "value" for the crossorigin attribute. Allowed values are: "anonymous", "use-credentials".'
        );

        Img::widget()->crossorigin('value');
    }

    public function testLoadingWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must not be empty. The valid values are: "eager", "lazy".');

        Img::widget()->loading('');
    }

    public function testLoadingWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "value" for the loading attribute. Allowed values are: "eager", "lazy".'
        );

        Img::widget()->loading('value');
    }
}
