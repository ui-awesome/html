<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Ol;

use PHPForge\Support\Assert;
use UIAwesome\Html\Group\{Li, Ol};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ol>
            </ol>
            HTML,
            Ol::widget()->render()
        );
    }

    public function testRenderWithNested(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ol>
            <li>
            first item
            </li>
            <li>
            second item
            <ol>
            <li>
            second item first subitem
            </li>
            <li>
            second item second subitem
            </li>
            <li>
            second item third subitem
            </li>
            </ol>
            </li>
            <li>
            third item
            </li>
            </ol>
            HTML,
            Ol::widget()
                ->content(
                    Li::widget()->content('first item'),
                    Li::widget()
                        ->content(
                            'second item',
                            Ol::widget()
                                ->content(
                                    Li::widget()->content('second item first subitem'),
                                    Li::widget()->content('second item second subitem'),
                                    Li::widget()->content('second item third subitem')
                                )
                        ),
                    Li::widget()->content('third item')
                )
                ->render()
        );
    }
}
