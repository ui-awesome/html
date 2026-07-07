<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<legend>` element for captions in a `<fieldset>`.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Legend::tag()
 *     ->content('Choose your favorite monster')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/legend
 * {@see BaseBlock} for the base implementation.
 */
final class Legend extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<legend>` element.
     *
     * @return Block Tag enumeration instance for `<legend>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::LEGEND;
    }
}
