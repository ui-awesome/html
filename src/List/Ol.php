<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\LineBreakNormalizer;
use UIAwesome\Html\Interop\{BlockInterface, Lists};
use UIAwesome\Html\List\Attribute\{HasReversed, HasStart};

/**
 * Renders the HTML `<ol>` element for ordered lists.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Ol::tag()
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
     * Appends multiple `<li>` elements to the ordered list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Ol::tag()->items(
     *     'First step',
     *     'Second step',
     *     'Third step',
     * );
     * ```
     *
     * @param string|Stringable ...$items Items to add as `<li>` elements.
     *
     * @return static New instance with the appended list items.
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
     * Appends a `<li>` element to the ordered list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Ol::tag()
     *     ->li('Install dependencies')
     *     ->li('Run tests', 5);
     * ```
     *
     * @param string|Stringable $content Content for the `<li>` element.
     * @param int|string|null $value Optional ordinal value for the list item, or `null` to omit the attribute.
     *
     * @return static New instance with the appended list item.
     */
    public function li(string|Stringable $content, int|string|null $value = null): static
    {
        $li = Li::tag()->content($content);

        if ($value !== null) {
            $li = $li->value($value);
        }

        return $this->html($li->render(), "\n");
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
