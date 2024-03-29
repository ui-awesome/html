<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasMax,
    Attribute\FormControl\HasMin,
    Attribute\FormControl\HasPlaceholder,
    Attribute\FormControl\Input\HasStep,
    Attribute\HasValue,
    FormControl\Input\Base\AbstractInput,
    Helper\Validator,
    Interop\PlaceholderInterface,
    Interop\Validator\RangeLengthInterface,
    Interop\Validator\RequiredInterface,
    Interop\ValueInterface
};

/**
 * The input element with a type attribute whose value is "range" represents an imprecise control for setting the
 * element’s value to a string representing a number.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.number.html
 */
final class Number extends AbstractInput implements
    PlaceholderInterface,
    RangeLengthInterface,
    RequiredInterface,
    ValueInterface
{
    use CanBeRequired;
    use HasMax;
    use HasMin;
    use HasPlaceholder;
    use HasStep;
    use HasValue;

    protected string $type = 'number';

    protected function run(): string
    {
        Validator::isNumeric($this->getValue());

        return $this->renderInputTag($this->attributes);
    }
}
