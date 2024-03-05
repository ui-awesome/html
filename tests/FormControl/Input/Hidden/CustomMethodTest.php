<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Hidden;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Hidden;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="hidden-6582f2d099e8b" type="hidden">
            HTML,
            Hidden::widget()->id('hidden-6582f2d099e8b')->render()
        );
    }
}
