<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Mutlimedia\Img;

use UIAwesome\Html\Multimedia\Img;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Img::widget();

        $this->assertNotSame($instance, $instance->crossorigin('anonymous'));
        $this->assertNotSame($instance, $instance->ismap());
        $this->assertNotSame($instance, $instance->loading('lazy'));
        $this->assertNotSame($instance, $instance->sizes(''));
        $this->assertNotSame($instance, $instance->srcset(''));
    }
}
