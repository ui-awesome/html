<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\H;

use UIAwesome\Html\Semantic\H;

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testTagnameWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('H::class widget must have a tag name.');

        H::widget()->tagName('')->render();
    }

    public function testTagnameWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "span" for the tagname method. Allowed values are: "h1", "h2", "h3", "h4", "h5", "h6".'
        );

        H::widget()->tagName('span')->render();
    }
}
