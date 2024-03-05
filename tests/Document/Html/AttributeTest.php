<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Document\Html;

use PHPForge\Support\Assert;
use UIAwesome\Html\Document\Html;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html class="value">
            </html>
            HTML,
            Html::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html class="value">
            </html>
            HTML,
            Html::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html>
            value
            </html>
            HTML,
            Html::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html data-value="value">
            </html>
            HTML,
            Html::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html id="value">
            </html>
            HTML,
            Html::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html lang="value">
            </html>
            HTML,
            Html::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html style="value">
            </html>
            HTML,
            Html::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <html title="value">
            </html>
            HTML,
            Html::widget()->title('value')->render()
        );
    }
}
