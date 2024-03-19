<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\{Html\FormControl\Input\Checkbox, Html\FormControl\Input\CheckboxList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->disableLabel()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->label('Select your gender?')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="checkboxlist-w0"><input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">Apple</label>
            <label for="checkboxlist-w1"><input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">Banana</label>
            <label for="checkboxlist-w2"><input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->enclosedByLabel(true)
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="value">Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->labelAttributes(['class' => 'value'])
                ->label('Select your fruits?')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="value">Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->labelClass('value')
                ->label('Select your fruits?')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->label('Select your fruits?')
                ->labelFor('value')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label class="value-1" for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label class="value value-1" for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label class="value-1" for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->labelClass('value')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->label('Select your fruits?')
                ->labelItemClass('value-1')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelItemClassWithOverrideTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your fruits?</label>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label class="override-value" for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label class="override-value" for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label class="override-value" for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->labelClass('value')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->labelClass('value')->value(3),
                )
                ->label('Select your fruits?')
                ->labelItemClass('override-value', true)
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }
}
