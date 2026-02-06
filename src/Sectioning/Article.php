<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<article>` element for self-contained content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Sectioning\Article::tag()
 *     ->class('blog-post')
 *     ->content('Article content here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/article
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Article extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<article>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<article>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::ARTICLE;
    }
}
