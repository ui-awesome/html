<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Document\Head;

use PHPForge\Support\Assert;
use UIAwesome\Html\Document\Head;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testBeginEnd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <head>value</head>
            HTML,
            Head::widget()->begin() . 'value' . Head::end()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <head>
            </head>
            HTML,
            Head::widget()->render()
        );
    }
}
