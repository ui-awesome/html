<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Form\{
    CanBeReadonly,
    CanBeRequired,
    HasAutocomplete,
    HasDirname,
    HasForm,
    HasMaxlength,
    HasMinlength,
    HasPlaceholder,
};
use UIAwesome\Html\Attribute\Global\{HasAutocapitalize, HasAutocorrect};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Attribute\{HasCols, HasRows, HasWrap};
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<textarea>` element for multiline plain-text input.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\TextArea::tag()
 *     ->name('comment')
 *     ->rows(5)
 *     ->cols(33)
 *     ->placeholder('Enter your comment here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class TextArea extends BaseBlock
{
    use CanBeDisabled;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAutocapitalize;
    use HasAutocomplete;
    use HasAutocorrect;
    use HasCols;
    use HasDirname;
    use HasForm;
    use HasMaxlength;
    use HasMinlength;
    use HasName;
    use HasPlaceholder;
    use HasRows;
    use HasWrap;

    /**
     * Returns the tag enumeration for the `<textarea>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<textarea>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::TEXT_AREA;
    }
}
