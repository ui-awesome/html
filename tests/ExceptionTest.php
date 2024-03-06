<?php

declare(strict_types=1);

namespace PHPForge\Html\Tests;

use UIAwesome\Html\Builder;

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginInlineElement(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Inline elements cannot be used with begin/end syntax.');

        Builder::beginTag('br');
    }

    public function testEndInlineElement(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Inline elements cannot be used with begin/end syntax.');

        Builder::endTag('br');
    }

    public function testTagEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Builder::createTag('');
    }
}
