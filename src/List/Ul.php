<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Represents the HTML `<ul>` element for unordered lists.
 *
 * Provides a concrete `<ul>` element implementation that returns `Lists::UL` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<ul>` element represents an unordered list of items, typically rendered as a bulleted list.
 *
 * Key features.
 * - Container element accepts `<li>` child elements.
 * - Provides helper methods `li()` and `items()` for constructing valid list markup.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Ul;
 *
 * echo Ul::tag()
 *     ->class('my-list')
 *     ->items('First item', 'Second item', 'Third item')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Ul extends BaseBlock
{
    /**
     * Appends multiple list items to the unordered list.
     *
     * Creates a new instance with multiple `<li>` elements appended to the content.
     *
     * @param string|Stringable ...$items Variable number of items to add as list elements.
     *
     * @return static New instance with the appended list items.
     *
     * Usage example:
     * ```php
     * $list = Ul::tag()->items(
     *     'Apple',
     *     'Banana',
     *     'Cherry',
     * );
     * ```
     */
    public function items(string|Stringable ...$items): static
    {
        $ul = $this;

        foreach ($items as $item) {
            $ul = $ul->li($item);
        }

        return $ul;
    }

    /**
     * Appends a `<li>` element with the specified content to the unordered list.
     *
     * Creates a new instance with a `<li>` element appended to the content.
     *
     * @param string|Stringable $content The content to place inside the `<li>` element.
     * @param string|int|null $value Optional ordinal value for the list item (only meaningful in ordered lists).
     *
     * @return static New instance with the appended list item.
     *
     * Usage example:
     * ```php
     * $list = Ul::tag()
     *     ->li('Item', 3);
     * $list = Ul::tag()
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
     * Returns the tag enumeration for the `<ul>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<ul>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::UL;
    }
}
