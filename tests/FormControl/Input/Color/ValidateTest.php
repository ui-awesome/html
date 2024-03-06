<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Color;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Color;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="color-6582f2d099e8b" type="color" required>
            HTML,
            Color::widget()->id('color-6582f2d099e8b')->required()->render()
        );
    }
}
