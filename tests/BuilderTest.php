<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests;

use PHPForge\Support\Assert;
use UIAwesome\Html\Builder;

final class BuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testBegin(): void
    {
        $this->assertSame('<div>', Builder::beginTag('div'));
        $this->assertSame('<div class="class">', Builder::beginTag('div', ['class' => 'class']));
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
        Assert::equalsWithoutLE($expected, Builder::createTag($tagName, $content, $attributes));
    }

    public function testEnd(): void
    {
        $this->assertSame('</div>', Builder::endTag('div'));
    }
}
