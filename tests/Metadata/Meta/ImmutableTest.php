<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata\Meta;

use UIAwesome\Html\Metadata\Meta;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Meta::widget();

        $this->assertNotSame($instance, $instance->charset(''));
        $this->assertNotSame($instance, $instance->content(''));
        $this->assertNotSame($instance, $instance->httpEquiv(''));
    }
}
