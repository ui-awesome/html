<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input;

use UIAwesome\Html\{
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
 * The input element with a type attribute whose value is "tel" represents a one-line plain-text edit control for
 * entering a telephone number.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.tel.html#input.tel
 */
final class Tel extends AbstractInput implements
    LengthInterface,
    PatternInterface,
    PlaceholderInterface,
    RequiredInterface,
    ValueInterface
{
    use CanBeRequired;
    use HasAutocomplete;
    use HasDirname;
    use HasMaxLength;
    use HasMinLength;
    use HasPattern;
    use HasPlaceholder;
    use HasSize;
    use HasValue;

    protected string $type = 'tel';

    /**
     * @return string the generated input tag.
     */
    protected function run(): string
    {
        Validator::isNumeric($this->getValue());

        return $this->renderInputTag($this->attributes);
    }
}
