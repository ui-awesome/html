<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Hidden;

use PHPForge\Support\Assert;
use UIAwesome\Html\{FormControl\Input\Hidden, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        $instance = Hidden::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="hidden-6582f2d099e8b" type="hidden">
            HTML,
            $instance->id('hidden-6582f2d099e8b')->render()
        );
    }
}
