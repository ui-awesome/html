<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Generator;

use PHPForge\Support\Assert;
use UIAwesome\Html\Generator\Html;

final class HtmlTest extends \PHPUnit\Framework\TestCase
{
    public function testBegin(): void
    {
        $this->assertSame('<div>', Html::begin('div'));
        $this->assertSame('<div class="class">', Html::begin('div', ['class' => 'class']));
    }

    /**
     * @dataProvider UIAwesome\Html\Tests\Provider\TagProvider::create
     *
     * @param string $tagName Tag name.
     * @param string $content Tag content.
     * @param array $attributes Tag attributes.
     * @param string $expected Expected result.
     */
    public function testCreate(string $tagName, string $content, array $attributes, string $expected): void
    {
        Assert::equalsWithoutLE($expected, Html::create($tagName, $content, $attributes));
    }

    public function testEnd(): void
    {
        $this->assertSame('</div>', Html::end('div'));
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Html::create('');
    }
}
