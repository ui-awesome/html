<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\SelectTag;

/**
 * Renders the HTML `<datalist>` element for predefined input suggestions.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Datalist::tag()
 *     ->id('ice-cream-flavors')
 *     ->option(\UIAwesome\Html\Form\Option::tag()->value('Chocolate'))
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/datalist
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Datalist extends BaseBlock
{
    /**
     * Appends an `<option>` element to the datalist.
     *
     * @param Option $option Option element instance.
     *
     * @return static New instance with the appended option.
     */
    public function option(Option $option): static
    {
        return $this->html($option->render(), "\n");
    }

    /**
     * Returns the tag enumeration for the `<datalist>` element.
     *
     * @return SelectTag Tag enumeration instance for `<datalist>`.
     */
    protected function getTag(): SelectTag
    {
        return SelectTag::DATALIST;
    }
}
