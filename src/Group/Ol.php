<?php

declare(strict_types=1);

namespace UIAwesome\Html\Group;

use UIAwesome\Html\Attribute\HasType;

/**
 * The `<ol> HTML element represents an ordered list of items, typically rendered as a numbered list.
 *
 * @link https://html.spec.whatwg.org/multipage/grouping-content.html#the-ol-element
 */
final class Ol extends AbstractList
{
    use HasType;

    /**
     * Set the reversed attribute.
     *
     * @return static A new instance of the current class with the specified reversed value.
     *
     * @link https://html.spec.whatwg.org/multipage/grouping-content.html#attr-ol-reversed
     */
    public function reversed(): static
    {
        $new = clone $this;
        $new->attributes['reversed'] = true;

        return $new;
    }

    /**
     * The start attribute specifies the value of the first list item in an ordered list.
     *
     * @param int $value The value of the first list item in an ordered list.
     *
     * @return static A new instance of the current class with the specified start value.
     *
     * @link https://html.spec.whatwg.org/multipage/grouping-content.html#attr-ol-start
     */
    public function start(int $value): static
    {
        $new = clone $this;
        $new->attributes['start'] = $value;

        return $new;
    }

    protected string $tagName = 'ol';
}
