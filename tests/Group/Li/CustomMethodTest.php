<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Group\Li;

use PHPForge\Support\Assert;
use UIAwesome\Html\{Group\Li, Group\Ul, Interop\RenderInterface};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender(): void
    {
        $instance = Li::widget();

        $this->assertInstanceOf(RenderInterface::class, $instance);
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            </li>
            HTML,
            $instance->render()
        );
    }

    public function testRenderWithNested(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <ul>
            <li>
            Item 1
            </li>
            <li>
            Item 2
            </li>
            </ul>
            </li>
            HTML,
            Li::widget()->content(
                Ul::widget()->content(
                    Li::widget()->content('Item 1'),
                    Li::widget()->content('Item 2')
                )
            )
            ->render()
        );
    }
}
