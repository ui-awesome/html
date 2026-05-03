<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Global\HasAutocapitalize;
use UIAwesome\Html\Attribute\{HasName, HasRel, HasTarget};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\{Enctype, Method};
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Block;
use UnitEnum;

/**
 * Renders the HTML `<form>` element for submitting user data.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Form::tag()
 *     ->action('/submit')
 *     ->method('post')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Form extends BaseBlock
{
    use HasAutocapitalize;
    use HasName;
    use HasRel;
    use HasTarget;

    /**
     * Sets the `accept-charset` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->acceptCharset('UTF-8')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Character encoding for form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `accept-charset` attribute.
     */
    public function acceptCharset(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('accept-charset', $value);
    }

    /**
     * Sets the `action` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->action('/submit')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value URL that processes the form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `action` attribute.
     */
    public function action(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('action', $value);
    }

    /**
     * Sets the `autocomplete` attribute.
     *
     * Usage example:
     * ```php
     * $element->autocomplete('on');
     * $element->autocomplete('email');
     * $element->autocomplete('new-password');
     * $element->autocomplete(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Autocomplete value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `autocomplete` attribute.
     */
    public function autocomplete(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::AUTOCOMPLETE, $value);
    }

    /**
     * Sets the `enctype` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->enctype('multipart/form-data')
     *     ->render();
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->enctype(\UIAwesome\Html\Form\Values\Enctype::MULTIPART_FORM_DATA)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value MIME type for form submission ('application/x-www-form-urlencoded',
     * 'multipart/form-data', or 'text/plain'), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `enctype` attribute.
     *
     * {@see Enctype} for predefined enum values.
     */
    public function enctype(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Enctype::cases(), 'enctype');

        return $this->addAttribute('enctype', $value);
    }

    /**
     * Sets the `method` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->method('post')
     *     ->render();
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->method(\UIAwesome\Html\Form\Values\Method::POST)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value HTTP method for form submission ('get', 'post', or 'dialog'), or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `method` attribute.
     *
     * {@see Method} for predefined enum values.
     */
    public function method(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Method::cases(), 'method');

        return $this->addAttribute('method', $value);
    }

    /**
     * Sets the `novalidate` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->novalidate(true)
     *     ->render();
     * ```
     *
     * @param bool|null $value Whether to bypass form validation on submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `novalidate` attribute.
     */
    public function novalidate(bool|null $value): static
    {
        return $this->addAttribute('novalidate', $value);
    }

    /**
     * Returns the tag enumeration for the `<form>` element.
     *
     * @return Block Tag enumeration instance for `<form>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::FORM;
    }
}
