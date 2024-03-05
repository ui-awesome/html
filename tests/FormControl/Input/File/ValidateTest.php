<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Input\File;

use PHPForge\Support\Assert;
use UIAwesome\Html\FormControl\Input\File;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidateTest extends \PHPUnit\Framework\TestCase
{
    public function testAccept(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="file-65a15e0439570" type="file" accept="value">
            HTML,
            File::widget()->accept('value')->id('file-65a15e0439570')->render()
        );
    }

    public function testRequired(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="file-65a15e0439570" type="file" required>
            HTML,
            File::widget()->id('file-65a15e0439570')->required()->render()
        );
    }
}
