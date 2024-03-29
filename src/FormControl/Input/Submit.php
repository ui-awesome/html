<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\Helper\Utils;

/**
 * The input element with a type attribute whose value is "submit" represents a button for submitting a form.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.submit.html#input.submit
 */
final class Submit extends Base\AbstractButton
{
    protected string $type = 'submit';

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        $defaultDefinitions = parent::loadDefaultDefinitions();
        $defaultDefinitions['id()'] = [Utils::generateId('submit-')];

        return $defaultDefinitions;
    }
}
