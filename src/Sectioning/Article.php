<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<article>` element for self-contained composition content.
 *
 * Provides a concrete `<article>` element implementation that returns `Block::ARTICLE` and inherits block-level
 * rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<article>` element represents a self-contained composition in a document, page, application, or site, which is
 * intended to be independently distributable or reusable (e.g., in syndication). Examples include: a forum post, a
 * magazine or newspaper article, or a blog entry, a product card, a user-submitted comment, an interactive widget or
 * gadget, or any other independent item of content.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Sectioning\Article;
 *
 * echo Article::tag()
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
