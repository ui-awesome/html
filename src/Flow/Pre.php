<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<pre>` element for preformatted text.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Pre::tag()
 *     ->class('listing')
 *     ->content('var_dump($value);')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/pre
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Pre extends BaseBlock
{
    /**
     * Skips line break normalization for {@see Pre} content.
     *
     * In preformatted text, all whitespace including newlines and trailing spaces are semantic and must be preserved
     * exactly as provided by the user.
     *
     * @param string $result Rendered HTML output.
     *
     * @return string Rendered HTML without normalization.
     */
    protected function afterRun(string $result): string
    {
        return $result;
    }
    /**
     * Returns the tag enumeration for the `<pre>` element.
     *
     * @return Block Tag enumeration instance for `<pre>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::PRE;
    }

    /**
     * Renders the {@see Pre} element preserving all whitespace.
     *
     * Unlike other block elements, whitespace is semantic in {@see Pre} and must not be normalized.
     *
     * @return string Rendered HTML preserving exact whitespace.
     */
    protected function run(): string
    {
        if ($this->isBeginExecuted() === false) {
            return Html::element($this->getTag(), $this->getContent(), $this->getAttributes());
        }

        return Html::end($this->getTag());
    }
}
