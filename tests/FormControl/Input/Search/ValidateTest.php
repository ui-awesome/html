<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\Search;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\Search;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testMaxLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="search-6582f2d099e8b" type="search" maxlength="1">
            HTML,
            Search::widget()->id('search-6582f2d099e8b')->maxlength(1)->render()
        );
    }

    public function testMinLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="search-6582f2d099e8b" type="search" minlength="1">
            HTML,
            Search::widget()->id('search-6582f2d099e8b')->minlength(1)->render()
        );
    }

    public function testPattern(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="search-6582f2d099e8b" type="search" pattern="value">
            HTML,
            Search::widget()->id('search-6582f2d099e8b')->pattern('value')->render()
        );
    }

    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="search-6582f2d099e8b" type="search" required>
            HTML,
            Search::widget()->id('search-6582f2d099e8b')->required()->render()
        );
    }
}
