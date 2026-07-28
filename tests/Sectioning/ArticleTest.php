<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Sectioning;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Sectioning\Article;

/**
 * Unit tests for {@see Article} rendering and template attribute behavior.
 */
#[Group('sectioning')]
final class ArticleTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <article>
            &lt;value&gt;
            </article>
            HTML,
            Article::tag()->content('<value>')->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <article class="default-class">
            </article>
            HTML,
            Article::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <article>
            </article>
            HTML,
            (string) Article::tag(),
            'Casting to string must produce HTML.',
        );
    }
}
