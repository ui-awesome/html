<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\LineBreakNormalizer;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Renders the HTML `<ul>` element for unordered lists.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Ul::tag()
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
     * Appends multiple `<li>` elements to the unordered list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Ul::tag()->items(
     *     'Apple',
     *     'Banana',
     *     'Cherry',
     * );
     * ```
     *
     * @param string|Stringable ...$items Items to add as `<li>` elements.
     *
     * @return static New instance with the appended list items.
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
     * Appends a `<li>` element to the unordered list.
     *
     * Usage example:
     * ```php
     * $list = \UIAwesome\Html\List\Ul::tag()
     *     ->li('First item')
     *     ->li('Second item');
     * ```
     *
     * @param string|Stringable $content Content for the `<li>` element.
     * @param int|string|null $value Optional `value` attribute for the list item, or `null` to omit the attribute.
     *
     * @return static New instance with the appended list item.
     */
    public function li(string|Stringable $content, int|string|null $value = null): static
    {
        $li = Li::tag()->content($content);

        if ($value !== null) {
            $li = $li->value($value);
        }

        return $this->html($li->render(), PHP_EOL);
    }

    /**
     * Cleans up the output after rendering the block element.
     *
     * Removes excessive consecutive newlines from the rendered output to ensure clean HTML structure.
     *
     * @param string $result Rendered HTML output.
     *
     * @return string Cleaned HTML output with excessive newlines removed.
     */
    protected function afterRun(string $result): string
    {
        return parent::afterRun(LineBreakNormalizer::normalize($result));
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
