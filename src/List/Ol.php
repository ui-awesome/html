<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};
use UIAwesome\Html\List\Attribute\{HasReversed, HasStart};

/**
 * Represents the HTML `<ol>` element for ordered lists.
 *
 * Provides a concrete `<ol>` element implementation that returns `Lists::OL` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<ol>` element represents an ordered list of items, typically rendered as a numbered list.
 *
 * Key features.
 * - Container element accepts `<li>` child elements.
 * - Provides helper methods `li()` and `items()` for constructing valid list markup.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 * - Supports ol-specific attributes via helper methods (`reversed`, `start`).
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Ol;
 *
 * echo Ol::tag()
 *     ->class('my-list')
 *     ->items('First item', 'Second item', 'Third item')
 *     ->reversed(true)
 *     ->start(5)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ol
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Ol extends BaseBlock
{
    use HasReversed;
    use HasStart;

    /**
     * Appends multiple list items to the ordered list.
     *
     * Creates a new instance with multiple `<li>` elements appended to the content.
     *
     * @param string|Stringable ...$items Variable number of items to add as list elements.
     *
     * @return static New instance with the appended list items.
     *
     * Usage example:
     * ```php
     * $list = Ol::tag()->items(
     *     'First step',
     *     'Second step',
     *     'Third step',
     * );
     * ```
     */
    public function items(string|Stringable ...$items): static
    {
        $ol = $this;

        foreach ($items as $item) {
            $ol = $ol->li($item);
        }

        return $ol;
    }

    /**
     * Appends a `<li>` element with the specified content to the ordered list.
     *
     * Creates a new instance with a `<li>` element appended to the content.
     *
     * @param string|Stringable $content Content to place inside the `<li>` element.
     * @param int|string|null $value Optional ordinal value for the list item.
     *
     * @return static New instance with the appended list item.
     *
     * Usage example:
     * ```php
     * $list = Ol::tag()
     *     ->li('Item with value', 3);
     * $list = Ol::tag()
     *     ->li('First item')
     *     ->li('Second item');
     * ```
     */
    public function li(string|Stringable $content, string|int|null $value = null): static
    {
        $li = Li::tag()->content($content);

        if ($value !== null) {
            $li = $li->value($value);
        }

        return $this->html($li->render(), PHP_EOL);
    }

    /**
     * Returns the tag enumeration for the `<ol>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<ol>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::OL;
    }
}
