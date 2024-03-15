<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Hr;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\Hr;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <hr class="value">
            HTML,
            Hr::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <hr class="value">
            HTML,
            Hr::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <hr size="1">
            HTML,
            Hr::widget()->size(1)->render()
        );
    }

    public function testWidth(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <hr width="1">
            HTML,
            Hr::widget()->width(1)->render()
        );
    }
}
