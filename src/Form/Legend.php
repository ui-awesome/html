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
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/legend
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
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
