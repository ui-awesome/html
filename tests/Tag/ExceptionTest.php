<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Tag;

use UIAwesome\Html\Tag;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testWithoutTagName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Tag::widget()->render();
    }
}
