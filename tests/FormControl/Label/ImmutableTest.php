<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Label;

use UIAwesome\Html\FormControl\Label;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Label::widget();

        $this->assertNotSame($instance, $instance->for(''));
    }
}
