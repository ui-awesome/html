<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, HasLabel};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\SelectTag;

/**
 * Renders the HTML `<optgroup>` element for grouping options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Optgroup::tag()
 *     ->content(\UIAwesome\Html\Form\Option::tag()->value('scl')->content('Santiago'))
 *     ->label('Cities')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/optgroup
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Optgroup extends BaseBlock
{
    use CanBeDisabled;
    use HasLabel;

    /**
     * Appends an `<option>` element to the option group.
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
     * Returns the tag enumeration for the `<optgroup>` element.
     *
     * @return SelectTag Tag enumeration instance for `<optgroup>`.
     */
    protected function getTag(): SelectTag
    {
        return SelectTag::OPTGROUP;
    }
}
