<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents tag values used by select and datalist elements.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum SelectTag: string
{
    /**
     * Case for the `<datalist>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/datalist
     */
    case DATALIST = 'datalist';

    /**
     * Case for the `<optgroup>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/optgroup
     */
    case OPTGROUP = 'optgroup';

    /**
     * Case for the `<option>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/option
     */
    case OPTION = 'option';
}
