<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
    Attribute\FormControl\CanBeMultiple,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasAutocomplete,
    Attribute\FormControl\HasDirname,
    Attribute\FormControl\HasMaxLength,
    Attribute\FormControl\HasMinLength,
    Attribute\FormControl\HasPlaceholder,
    Attribute\FormControl\HasSize,
    Attribute\FormControl\Input\HasPattern,
    Attribute\HasValue,
    FormControl\Input\Base\AbstractInput,
    Helper\Validator,
    Interop\PlaceholderInterface,
    Interop\Validator\LengthInterface,
    Interop\Validator\PatternInterface,
    Interop\Validator\RequiredInterface,
    Interop\ValueInterface
};

/**
 * The input element with a type attribute whose value is "email" represents a control for editing a list of e-mail
 * addresses given in the element’s value.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.email.html#input.email
 */
final class Email extends AbstractInput implements
    LengthInterface,
    PatternInterface,
    PlaceholderInterface,
    RequiredInterface,
    ValueInterface
{
    use CanBeMultiple;
    use CanBeRequired;
    use HasAutocomplete;
    use HasDirname;
    use HasMaxLength;
    use HasMinLength;
    use HasPattern;
    use HasPlaceholder;
    use HasSize;
    use HasValue;

    protected string $type = 'email';

    protected function run(): string
    {
        Validator::isString($this->getValue());

        return $this->renderInputTag($this->attributes);
    }
}
