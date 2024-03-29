<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Button;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Button;

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
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->disableLabel()->label('Label')->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="button-6582f2d099e8b">Label</label>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="button-6582f2d099e8b">Label</label>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()
                ->id('button-6582f2d099e8b')
                ->label('Label')
                ->labelAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLabelClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="button-6582f2d099e8b">Label</label>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->label('Label')->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="value">Label</label>
            <input id="button-6582f2d099e8b" type="button">
            </div>
            HTML,
            Button::widget()->id('button-6582f2d099e8b')->label('Label')->LabelFor('value')->render()
        );
    }
}
