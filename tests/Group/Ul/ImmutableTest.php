<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Ul;

use UIAwesome\Html\Group\Ul;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Ul::widget();

        $this->assertNotSame($instance, $instance->content(''));
    }
}
