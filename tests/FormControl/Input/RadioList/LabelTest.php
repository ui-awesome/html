<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Radio, RadioList};

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
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->disableLabel()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->label('Select your gender?')
                ->name('radioform[text]')
                ->render(),
        );
    }

    public function testEnclosedByLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="radiolist-w0"><input id="radiolist-w0" name="radioform[text]" type="radio" value="1">Female</label>
            <label for="radiolist-w1"><input id="radiolist-w1" name="radioform[text]" type="radio" value="2">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->enclosedByLabel(true)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render(),
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="value">Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->labelAttributes(['class' => 'value'])
                ->label('Select your gender?')
                ->name('radioform[text]')
                ->render(),
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label class="value">Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->label('Select your gender?')
                ->labelClass('value')
                ->name('radioform[text]')
                ->render(),
        );
    }

    public function testLabelItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="CheckboxForm[text]" type="radio" value="1">
            <label class="value value-1" for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="CheckboxForm[text]" type="radio" value="2">
            <label class="value-1" for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->labelClass('value')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->label('Select your gender?')
                ->labelItemClass('value-1')
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }

    public function testLabelItemClassWithOverrideTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="CheckboxForm[text]" type="radio" value="1">
            <label class="override-value" for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="CheckboxForm[text]" type="radio" value="2">
            <label class="override-value" for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->labelClass('value')->value(2),
                )
                ->label('Select your gender?')
                ->labelItemClass('override-value', true)
                ->name('CheckboxForm[text]')
                ->render(),
        );
    }
}
