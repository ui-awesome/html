<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Ul;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Group\Li, Group\Ul, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        $instance = Ul::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <ul>
            </ul>
            HTML,
            $instance->render()
        );
    }

    public function testRenderWithNested(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul>
            <li>
            Item 1
            <ul>
            <li>
            Item 1.1
            </li>
            <li>
            Item 1.2
            </li>
            </ul>
            </li>
            <li>
            Item 2
            </li>
            </ul>
            HTML,
            Ul::widget()
                ->content(
                    Li::widget()
                        ->content(
                            'Item 1',
                            Ul::widget()
                                ->content(
                                    Li::widget()->content('Item 1.1'),
                                    Li::widget()->content('Item 1.2'),
                                ),
                        ),
                    Li::widget()->content('Item 2'),
                )
                ->render(),
        );
    }
}
