<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Checkbox, CheckboxList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="2" required>
            <label for="checkboxlist-w0">Banana</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="3" required>
            <label for="checkboxlist-w1">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->label('Select your fruits?')
                ->name('CheckboxForm[text]')
                ->required()
                ->render(),
        );
    }
}
