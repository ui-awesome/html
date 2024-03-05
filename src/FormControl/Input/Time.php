<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasMax,
    Attribute\FormControl\HasMin,
    Attribute\FormControl\Input\HasStep,
    Attribute\HasValue,
    FormControl\Input\Base\AbstractInput,
    Helper\Validator,
    Interop\Validator\RangeLengthInterface,
    Interop\Validator\RequiredInterface,
    Interop\ValueInterface
};

/**
 * The input element with a type attribute whose value is "time" represents a control for setting the element’s value to
 * a string representing a time (with no timezone information).
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.time.html#input.time
 */
final class Time extends AbstractInput implements RangeLengthInterface, RequiredInterface, ValueInterface
{
    use CanBeRequired;
    use HasMax;
    use HasMin;
    use HasStep;
    use HasValue;

    protected string $type = 'time';

    protected function run(): string
    {
        Validator::isString($this->getValue());

        return $this->renderInputTag($this->attributes);
    }
}
