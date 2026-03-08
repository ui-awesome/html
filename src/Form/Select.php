<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Form\{CanBeMultiple, CanBeRequired, HasAutocomplete, HasForm, HasSize};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<select>` element for choosing one or more options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Select::tag()
 *     ->name('pets')
 *     ->option(\UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'))
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/select
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Select extends BaseBlock
{
    use CanBeDisabled;
    use CanBeMultiple;
    use CanBeRequired;
    use HasAutocomplete;
    use HasForm;
    use HasName;
    use HasSize;

    /**
     * Appends an `<optgroup>` element to the select.
     *
     * @param Optgroup $optgroup Optgroup element instance.
     *
     * @return static New instance with the appended optgroup.
     */
    public function optgroup(Optgroup $optgroup): static
    {
        return $this->html($optgroup, "\n");
    }

    /**
     * Appends an `<option>` element to the select.
     *
     * @param Option $option Option element instance.
     *
     * @return static New instance with the appended option.
     */
    public function option(Option $option): static
    {
        return $this->html($option, "\n");
    }

    /**
     * Returns the tag enumeration for the `<select>` element.
     *
     * @return Block Tag enumeration instance for `<select>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::SELECT;
    }
}
