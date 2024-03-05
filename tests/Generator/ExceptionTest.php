<?php

declare(strict_types=1);

namespace PHPForge\Html\Tests\Generator;

use UIAwesome\Html\Generator\Html;

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginInlineElement(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Inline elements cannot be used with begin/end syntax.');

        Html::begin('br');
    }

    public function testEndInlineElement(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Inline elements cannot be used with begin/end syntax.');

        Html::end('br');
    }

    public function testTagEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Html::create('');
    }
}
