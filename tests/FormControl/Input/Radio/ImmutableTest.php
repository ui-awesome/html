<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Radio;

use UIAwesome\Html\FormControl\Input\Radio;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Radio::widget();

        $this->assertNotSame($instance, $instance->enclosedByLabel(false));
    }
}
