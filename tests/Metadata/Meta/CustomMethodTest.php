<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Metadata\Meta;

use PHPForge\Support\Assert;
use UIAwesome\Html\Metadata\Meta;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <meta>
            HTML,
            Meta::widget()->render()
        );
    }
}
