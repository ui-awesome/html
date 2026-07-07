<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents tag values used by select and datalist elements.
 */
enum SelectTag: string
{
    /**
     * Case for the `<datalist>` HTML tag.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/datalist
     */
    case DATALIST = 'datalist';

    /**
     * Case for the `<optgroup>` HTML tag.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/optgroup
     */
    case OPTGROUP = 'optgroup';

    /**
     * Case for the `<option>` HTML tag.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/option
     */
    case OPTION = 'option';
}
