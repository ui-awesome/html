<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\{Radio, RadioList};

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
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1" aria-describedby="value">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2" aria-describedby="value">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->ariaDescribedBy('value')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1" aria-label="value">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2" aria-label="value">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->ariaLabel('value')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input class="value" id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->attributes(['class' => 'value'])
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div autofocus>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->autofocus()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testChecked(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2" checked>
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->checked(2)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testCheckedWithNull(): void
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
                ->checked(null)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="value" id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input class="value" id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->class('value')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testGenerateAriaDescribedBy(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1" aria-describedby="radiolist-help">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2" aria-describedby="radiolist-help">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->ariaDescribedBy()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testGenerateAriaDescribedByWithFalse(): void
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
                ->ariaDescribedBy(false)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString(
            'id="radiolist-',
            RadioList::widget()
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="value-w0" name="radioform[text]" type="radio" value="1">
            <label for="value-w0">Female</label>
            <input id="value-w1" name="radioform[text]" type="radio" value="2">
            <label for="value-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('value')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label>Select your gender?</label>
            <div>
            <input id="radiolist-w0" name="value" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="value" type="radio" value="2">
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
                ->name('value')
                ->render()
        );
    }

    public function testTabindex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div tabindex="1">
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="red">
            <label for="radiolist-w0">Red</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="blue">
            <label for="radiolist-w1">Blue</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Red')->value('red'),
                    Radio::widget()->label('Blue')->value('blue'),
                )
                ->name('radioform[text]')
                ->tabIndex(1)
                ->render()
        );
    }

    public function testValue(): void
    {
        // bool value
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="0" checked>
            <label for="radiolist-w0">inactive</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w1">active</label>
            </div>
            HTML,
            RadioList::widget()
                ->checked(false)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('inactive')->value(false),
                    Radio::widget()->label('active')->value(true),
                )
                ->name('radioform[text]')
                ->render()
        );

        // int value
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1" checked>
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->checked(1)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value('1'),
                    Radio::widget()->label('Male')->value('2'),
                )
                ->name('radioform[text]')
                ->render()
        );

        // string value
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="red" checked>
            <label for="radiolist-w0">Red</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="blue">
            <label for="radiolist-w1">Blue</label>
            </div>
            HTML,
            RadioList::widget()
                ->checked('red')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Red')->value('red'),
                    Radio::widget()->label('Blue')->value('blue'),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testValueWithNull(): void
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
                ->checked(null)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="radioform[text]" type="radio" value="1">
            <label>Female</label>
            <input name="radioform[text]" type="radio" value="2">
            <label>Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->fieldAttributes('ModelName', 'fieldName')
                ->id(null)
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testWithoutName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="modelname-fieldname-w0" type="radio" value="1">
            <label for="modelname-fieldname-w0">Female</label>
            <input id="modelname-fieldname-w1" type="radio" value="2">
            <label for="modelname-fieldname-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->fieldAttributes('ModelName', 'fieldName')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name(null)
                ->render()
        );
    }
}
