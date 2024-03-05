<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Submit;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Submit;

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
            <input id="submit-6582f2d099e8b" type="submit">
            </div>
            HTML,
            Submit::widget()->disableLabel()->id('submit-6582f2d099e8b')->label('Label')->render()
        );
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="submit-6582f2d099e8b">Label</label>
            <input id="submit-6582f2d099e8b" type="submit">
            </div>
            HTML,
            Submit::widget()->id('submit-6582f2d099e8b')->label('Label')->render()
        );
    }

    public function testLabelAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="value" for="submit-6582f2d099e8b">Label</label>
            <input id="submit-6582f2d099e8b" type="submit">
            </div>
            HTML,
            Submit::widget()
                ->id('submit-6582f2d099e8b')
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
            <label class="value" for="submit-6582f2d099e8b">Label</label>
            <input id="submit-6582f2d099e8b" type="submit">
            </div>
            HTML,
            Submit::widget()->id('submit-6582f2d099e8b')->label('Label')->labelClass('value')->render()
        );
    }

    public function testLabelFor(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="label-for">Label</label>
            <input id="submit-6582f2d099e8b" type="submit">
            </div>
            HTML,
            Submit::widget()->id('submit-6582f2d099e8b')->label('Label')->LabelFor('label-for')->render()
        );
    }
}
