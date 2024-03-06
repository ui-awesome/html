<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Radio;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Radio;

final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radio-6582f2d099e8b" type="radio" required>
            HTML,
            Radio::widget()->id('radio-6582f2d099e8b')->required()->render()
        );
    }
}
