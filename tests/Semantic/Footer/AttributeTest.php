<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Semantic\Footer;

use PHPForge\Support\Assert;
use UIAwesome\Html\Semantic\Footer;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer class="value">
            </footer>
            HTML,
            Footer::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer class="value">
            </footer>
            HTML,
            Footer::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer>
            value
            </footer>
            HTML,
            Footer::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer data-value="value">
            </footer>
            HTML,
            Footer::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer id="value">
            </footer>
            HTML,
            Footer::widget()->id('value')->render()
        );
    }

    public function testLang(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer lang="value">
            </footer>
            HTML,
            Footer::widget()->lang('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer style="value">
            </footer>
            HTML,
            Footer::widget()->style('value')->render()
        );
    }

    public function testTitle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <footer title="value">
            </footer>
            HTML,
            Footer::widget()->title('value')->render()
        );
    }
}
