<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Checkbox, CheckboxList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" aria-describedby="value">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2" aria-describedby="value">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3" aria-describedby="value">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->ariaDescribedBy('value')
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" aria-label="value">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2" aria-label="value">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3" aria-label="value">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->ariaLabel('value')
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input class="value" id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input class="value" id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->attributes(['class' => 'value'])
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

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div autofocus>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->autofocus()
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

    public function testChecked(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" checked>
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2" checked>
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->checked([1, 2])
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

    public function testCheckedWithNull(): void
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
                ->checked(null)
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

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input class="value" id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input class="value" id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->class('value')
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

    public function testGenerateAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" aria-describedby="checkboxlist-help">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2" aria-describedby="checkboxlist-help">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3" aria-describedby="checkboxlist-help">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->ariaDescribedBy()
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

    public function testGenerateAriaDescribedByWithFalse(): void
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
                ->ariaDescribedBy(false)
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

    public function testGenerateId(): void
    {
        $this->assertStringContainsString(
            'id="checkboxlist-',
            CheckboxList::widget()
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="value-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="value-w0">Apple</label>
            <input id="value-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="value-w1">Banana</label>
            <input id="value-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="value-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->id('value')
                ->items(
                    Checkbox::widget()->id('id-checkbox-1')->label('Apple')->value(1),
                    Checkbox::widget()->id('id-checkbox-2')->label('Banana')->value(2),
                    Checkbox::widget()->id('id-checkbox-3')->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="value[]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="value[]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="value[]" type="checkbox" value="3">
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
                ->name('value')
                ->render(),
        );
    }

    public function testTabindex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div tabindex="1">
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
                ->name('CheckboxForm[text]')
                ->tabIndex(1)
                ->render(),
        );
    }

    public function testValue(): void
    {
        // array with int values
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" checked>
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3" checked>
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->checked([1, 3])
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value('1'),
                    Checkbox::widget()->label('Banana')->value('2'),
                    Checkbox::widget()->label('Orange')->value('3'),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );

        // array with string values
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1" checked>
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2" checked>
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->checked(['1', '2'])
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );

        // value not in array
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
                ->checked([7])
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );

        // empty array
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
                ->checked([])
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

    public function testValueWithNull(): void
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
                ->checked(null)
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->id('checkbox-6599b6a33dd96')->label('Apple')->value(1),
                    Checkbox::widget()->id('checkbox-6599b6a33dd98')->label('Banana')->value(2),
                    Checkbox::widget()->id('checkbox-6599b6a33dd97')->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="ModelName[fieldName][]" type="checkbox" value="1">
            <label>Apple</label>
            <input name="ModelName[fieldName][]" type="checkbox" value="2">
            <label>Banana</label>
            <input name="ModelName[fieldName][]" type="checkbox" value="3">
            <label>Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->fieldAttributes('ModelName', 'fieldName')
                ->id(null)
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->render(),
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="modelname-fieldname-w0" type="checkbox" value="1">
            <label for="modelname-fieldname-w0">Apple</label>
            <input id="modelname-fieldname-w1" type="checkbox" value="2">
            <label for="modelname-fieldname-w1">Banana</label>
            <input id="modelname-fieldname-w2" type="checkbox" value="3">
            <label for="modelname-fieldname-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->fieldAttributes('ModelName', 'fieldName')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name(null)
                ->render(),
        );
    }
}
