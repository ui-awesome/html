<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Tel;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Tel;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testMaxLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" maxlength="1">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->maxlength(1)->render()
        );
    }

    public function testMinLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" minlength="1">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->minlength(1)->render()
        );
    }

    public function testPattern(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" pattern="value">
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->pattern('value')->render()
        );
    }

    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="tel-6582f2d099e8b" type="tel" required>
            HTML,
            Tel::widget()->id('tel-6582f2d099e8b')->required()->render()
        );
    }
}
