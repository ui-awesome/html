<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\RadioList;

use PHPForge\Support\Assert;
use UIAwesome\{Html\FormControl\Input\Radio, Html\FormControl\Input\RadioList};

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
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->containerAttributes(['class' => 'value'])
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->containerClass('value')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testContainerTag(): void
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
                ->containerTag()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            HTML,
            RadioList::widget()
                ->containerTag(false)
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </article>
            HTML,
            RadioList::widget()
                ->containerTag('article')
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->name('radioform[text]')
                ->render()
        );
    }

    public function testFieldAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="modelname-fieldname-w0" name="ModelName[fieldName]" type="radio" value="1">
            <label for="modelname-fieldname-w0">Female</label>
            <input id="modelname-fieldname-w1" name="ModelName[fieldName]" type="radio" value="2">
            <label for="modelname-fieldname-w1">Male</label>
            </div>
            HTML,
            RadioList::widget()
                ->fieldAttributes('ModelName', 'fieldName')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
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
                ->render()
        );
    }

    public function testSeparator(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
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
                ->separator(PHP_EOL)
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input id="radiolist-w0" name="radioform[text]" type="radio" value="1">
            <label for="radiolist-w0">Female</label>
            <input id="radiolist-w1" name="radioform[text]" type="radio" value="2">
            <label for="radiolist-w1">Male</label>
            </div>
            <label>Select your fruits?</label>
            </div>
            HTML,
            RadioList::widget()
                ->id('radiolist')
                ->items(
                    Radio::widget()->label('Female')->value(1),
                    Radio::widget()->label('Male')->value(2),
                )
                ->label('Select your fruits?')
                ->name('radioform[text]')
                ->template('<div>\n{tag}\n{label}\n</div>')
                ->render()
        );
    }

    public function testUncheckAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="radioform[text]" type="hidden" value="none">
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
                ->uncheckedAttributes(['class' => 'value'])
                ->uncheckedValue('none')
                ->render(),
        );
    }

    public function testUncheckClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="radioform[text]" type="hidden" value="none">
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
                ->uncheckedClass('value')
                ->uncheckedValue('none')
                ->render(),
        );
    }

    public function testUncheckedValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input name="radioform[text]" type="hidden" value="none">
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
                ->uncheckedValue('none')
                ->render(),
        );
    }
}
