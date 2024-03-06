<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\TextArea;

use UIAwesome\Html\FormControl\TextArea;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = TextArea::widget();

        $this->assertNotSame($instance, $instance->cols(1));
        $this->assertNotSame($instance, $instance->rows(1));
        $this->assertNotSame($instance, $instance->wrap('hard'));
    }
}
