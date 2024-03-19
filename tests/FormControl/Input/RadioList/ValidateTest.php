<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Radio, RadioList};

final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="CheckboxForm[text]" type="radio" value="1" required>
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="CheckboxForm[text]" type="radio" value="2" required>
            <label class="value" for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->labelClass('value')->value(2),
                )
                ->label('Select your gender?')
                ->name('CheckboxForm[text]')
                ->required()
                ->render(),
        );
    }
}
