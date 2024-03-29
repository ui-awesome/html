<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Checkbox;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Checkbox;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkbox-6582f2d099e8b" type="checkbox" required>
            HTML,
            Checkbox::widget()->id('checkbox-6582f2d099e8b')->required()->render()
        );
    }
}
