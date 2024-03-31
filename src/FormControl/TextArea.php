<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl;

use UIAwesome\Html\{
    Attribute\CanBeAutofocus,
    Attribute\FormControl\CanBeDisabled,
    Attribute\FormControl\CanBeReadonly,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasAutocomplete,
    Attribute\FormControl\HasDirname,
    Attribute\FormControl\HasFieldAttributes,
    Attribute\FormControl\HasForm,
    Attribute\FormControl\HasMaxLength,
    Attribute\FormControl\HasMinLength,
    Attribute\FormControl\HasPlaceholder,
    Attribute\HasName,
    Attribute\HasTabindex,
    Concern\HasContent,
    Core\Base\AbstractElement,
    Helper\Utils,
    Helper\Validator,
    Interop\ContentInterface,
    Interop\InputInterface,
    Interop\PlaceholderInterface,
    Interop\RenderInterface,
    Interop\Validator\LengthInterface,
    Interop\Validator\RequiredInterface
};

/**
 * The `<textarea>` HTML element represents a multi-line plain-text editing control, useful when you want to allow users
 * to enter a sizable amount of free-form text, for example, a comment on a review or feedback form.
 *
 * @link https://html.spec.whatwg.org/multipage/form-elements.html#the-textarea-element
 */
final class TextArea extends AbstractElement implements
    ContentInterface,
    InputInterface,
    LengthInterface,
    PlaceholderInterface,
    RenderInterface,
    RequiredInterface
{
    use CanBeAutofocus;
    use CanBeDisabled;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAutocomplete;
    use HasContent;
    use HasDirname;
    use HasFieldAttributes;
    use HasForm;
    use HasMaxLength;
    use HasMinLength;
    use HasName;
    use HasPlaceholder;
    use HasTabindex;

    /**
     * Set the maximum number of characters per line of text for the UA to show.
     *
     * @param int $value The maximum number of characters per line of text for the UA to show.
     *
     * @return static A new instance of the current class with the specified cols value.
     *
     * @link https://html.spec.whatwg.org/multipage/form-elements.html#attr-textarea-cols
     */
    public function cols(int $value): static
    {
        $new = clone $this;
        $new->attributes['cols'] = $value;

        return $new;
    }

    /**
     * Set the number of lines of text for the UA to show.
     *
     * @param int $value The number of lines of text for the UA to show.
     *
     * @return static A new instance of the current class with the specified rows value.
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.rows
     */
    public function rows(int $value): static
    {
        $new = clone $this;
        $new->attributes['rows'] = $value;

        return $new;
    }

    /**
     * Set the wrap attribute is an enumerated attribute with two keywords and states: the soft keyword, which maps to
     * the Soft state, and the hard keyword which maps to the Hard state.
     *
     * The missing value default and invalid value default are the Soft state.
     *
     * @param string $value Has the hard and soft values.
     *
     * @throws \InvalidArgumentException If the wrap value is not one of the allowed values. Allowed values are:
     * `hard`, `soft`.
     *
     * @return static A new instance of the current class with the specified wrap value.
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.wrap.hard
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.wrap.soft
     */
    public function wrap(string $value = 'hard'): static
    {
        Validator::inList(
            $value,
            'Invalid value "%s" for the wrap attribute. Allowed values are: "%s".',
            'hard',
            'soft',
        );

        $new = clone $this;
        $new->attributes['wrap'] = $value;

        return $new;
    }

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'id()' => [Utils::generateId('textarea-')],
            'template()' => ['{prefix}\n{tag}\n{suffix}'],
        ];
    }

    protected function run(): string
    {
        return $this->buildElement('textarea', $this->content);
    }
}
