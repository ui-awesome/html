<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\ButtonGroup;

use PHPForge\Support\Assert;
use UIAwesome\Html\{
    FormControl\Input\ButtonGroup,
    FormControl\Input\Reset,
    FormControl\Input\Submit,
    Interop\RenderInterface
};

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
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->containerAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->containerClass('value')
                ->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->containerTag()
                ->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            </article>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->containerTag('article')
                ->render()
        );
    }

    public function testContainerTagWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->containerTag(false)
                ->render()
        );
    }

    public function testContainerTagWithFalseWithDefinitions(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            HTML,
            ButtonGroup::widget(['containerTag()' => [false]])
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->render()
        );
    }

    public function testIndividualContainer(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span><input id="button-6582f2d099e8a" type="submit" value="Submit"></span>
            <span><input id="button-6582f2d099e8b" type="reset" value="Reset"></span>
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->individualContainer('span')
                ->render()
        );
    }

    public function testRender(): void
    {
        $instance = ButtonGroup::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="button-6582f2d099e8a" type="submit" value="Submit">
            <input id="button-6582f2d099e8b" type="reset" value="Reset">
            </div>
            HTML,
            $instance
                ->buttons(
                    Submit::widget()->id('button-6582f2d099e8a')->value('Submit'),
                    Reset::widget()->id('button-6582f2d099e8b')->value('Reset'),
                )
                ->render()
        );
    }
}
