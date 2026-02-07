<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

/**
 * Provides methods to configure whether the element is enclosed by a label.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait CanBeEnclosedByLabel
{
    /**
     * Whether the element is enclosed by a label.
     */
    protected bool $enclosedByLabel = false;

    /**
     * Sets whether the element is enclosed by a label.
     *
     * Usage example:
     * ```php
     * $element->enclosedByLabel(true);
     * ```
     *
     * @param bool $value Whether the element is enclosed by a label.
     *
     * @return static New instance with the updated `enclosedByLabel` value.
     */
    public function enclosedByLabel(bool $value): static
    {
        $new = clone $this;
        $new->enclosedByLabel = $value;

        return $new;
    }
}
