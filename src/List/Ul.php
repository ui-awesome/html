<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Lists;

/**
 * Renders the HTML `<ul>` element for unordered lists.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul
 * {@see BaseBlock} for the base implementation.
 */
final class Ul extends BaseBlock
{
    /**
     * Appends multiple `<li>` elements to the unordered list.
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

        return $this->html($this->getContent() === '' ? '' : "\n", $li);
    }

    /**
     * Returns the tag enumeration for the `<ul>` element.
     *
     * @return Lists Tag enumeration instance for `<ul>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): Lists
    {
        return Lists::UL;
    }
}
