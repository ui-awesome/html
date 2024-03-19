<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\CheckboxList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Checkbox, CheckboxList};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->containerAttributes(['class' => 'value'])
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

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            HTML,
            CheckboxList::widget()
                ->containerClass('value')
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

    public function testContainerTag(): void
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
                ->containerTag()
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

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            HTML,
            CheckboxList::widget()
                ->containerTag(false)
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

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </article>
            HTML,
            CheckboxList::widget()
                ->containerTag('article')
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

    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="modelname-fieldname-w0" name="ModelName[fieldName][]" type="checkbox" value="1">
            <label for="modelname-fieldname-w0">Apple</label>
            <input id="modelname-fieldname-w1" name="ModelName[fieldName][]" type="checkbox" value="2">
            <label for="modelname-fieldname-w1">Banana</label>
            <input id="modelname-fieldname-w2" name="ModelName[fieldName][]" type="checkbox" value="3">
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
                ->render()
        );
    }

    public function testRender(): void
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

    public function testSeparator(): void
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
                ->id('checkboxlist')
                ->items(
                    Checkbox::widget()->label('Apple')->value(1),
                    Checkbox::widget()->label('Banana')->value(2),
                    Checkbox::widget()->label('Orange')->value(3),
                )
                ->name('CheckboxForm[text]')
                ->separator(PHP_EOL)
                ->render(),
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="checkboxlist-w0" name="CheckboxForm[text][]" type="checkbox" value="1">
            <label for="checkboxlist-w0">Apple</label>
            <input id="checkboxlist-w1" name="CheckboxForm[text][]" type="checkbox" value="2">
            <label for="checkboxlist-w1">Banana</label>
            <input id="checkboxlist-w2" name="CheckboxForm[text][]" type="checkbox" value="3">
            <label for="checkboxlist-w2">Orange</label>
            </div>
            <label>Select your fruits?</label>
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
                ->name('CheckboxForm[text]')
                ->template('<div>\n{tag}\n{label}\n</div>')
                ->render()
        );
    }

    public function testUnckededAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="CheckboxForm[text][]" type="hidden" value="0">
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
                ->uncheckedAttributes(['class' => 'value'])
                ->uncheckedValue('0')
                ->render()
        );
    }

    public function testUncheckedClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="CheckboxForm[text][]" type="hidden" value="0">
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
                ->uncheckedClass('value')
                ->uncheckedValue('0')
                ->render()
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="CheckboxForm[text][]" type="hidden" value="0">
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
                ->uncheckedValue('0')
                ->render()
        );
    }
}
