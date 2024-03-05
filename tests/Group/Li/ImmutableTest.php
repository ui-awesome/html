<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Li;

use UIAwesome\Html\Group\Li;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Li::widget();

        $this->assertNotSame($instance, $instance->content(''));
    }
}
