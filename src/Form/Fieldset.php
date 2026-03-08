<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Form\HasForm;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<fieldset>` element for grouping related form controls.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Fieldset::tag()
 *     ->disabled(true)
 *     ->form('profile-form')
 *     ->name('contact')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/fieldset
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Fieldset extends BaseBlock
{
    use CanBeDisabled;
    use HasForm;
    use HasName;

    /**
     * Returns the tag enumeration for the `<fieldset>` element.
     *
     * @return Block Tag enumeration instance for `<fieldset>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::FIELDSET;
    }
}
