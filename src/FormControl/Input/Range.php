<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
    Attribute\FormControl\HasAutocomplete,
    Attribute\FormControl\HasDirname,
    Attribute\FormControl\HasMax,
    Attribute\FormControl\HasMin,
    Attribute\FormControl\Input\HasStep,
    Attribute\HasValue,
    FormControl\Input\Base\AbstractInput,
    Helper\Validator,
    Interop\Validator\RangeLengthInterface,
    Interop\ValueInterface
};

/**
 * The input element with a type attribute whose value is "range" represents an imprecise control for setting the
 * element’s value to a string representing a number.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.range.html
 */
final class Range extends AbstractInput implements RangeLengthInterface, ValueInterface
{
    use HasAutocomplete;
    use HasDirname;
    use HasMax;
    use HasMin;
    use HasStep;
    use HasValue;

    protected string $type = 'range';

    protected function run(): string
    {
        Validator::isNumeric($this->getValue());

        return $this->renderInputTag($this->attributes);
    }
}
