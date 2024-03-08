<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Base;

use PHPForge\Widget\Block;
use UIAwesome\Html\{
    Attribute\FormControl\HasAccept,
    Attribute\FormControl\HasAutocomplete,
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasName,
    Attribute\HasRel,
    Attribute\HasStyle,
    Attribute\HasTitle,
    Concern\HasAttributes,
    Concern\HasContent,
    FormControl\Input\Hidden,
    Helper\HTMLBuilder,
    Helper\Validator,
    Interop\RenderInterface
};

use function explode;
use function implode;
use function strpos;
use function substr;
use function urldecode;

/**
 * Provides a foundation for creating HTML `form` elements with various attributes and content.
 */
abstract class AbstractForm extends Block implements RenderInterface
{
    use HasAccept;
    use HasAttributes;
    use HasAutocomplete;
    use HasClass;
    use HasContent;
    use HasId;
    use HasLang;
    use HasName;
    use HasRel;
    use HasStyle;
    use HasTitle;

    protected string $csrfName = '_csrf';
    protected string $csrfToken = '';

    /**
     * Set the action and form-action content attributes, if specified, must have a value that is a valid non-empty URL
     * surrounded by spaces.
     *
     * @param string $value The action attribute value.
     *
     * @return static A new instance of the current class with the specified action value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-action
     */
    public function action(string $value): static
    {
        $new = clone $this;
        $new->attributes['action'] = $value;

        return $new;
    }

    /**
     * Begin rendering the block element.
     *
     * @return string The opening tag of the block element.
     */
    public function begin(): string
    {
        parent::begin();

        $hiddenInputs = $this->renderHiddenInput();

        $html = HTMLBuilder::beginTag('form', $this->attributes);

        if ($hiddenInputs !== '') {
            $html .= "\n$hiddenInputs";
        }

        return "$html$this->content";
    }

    /**
     * Set the CSRF-token attribute token known to be safe to use.
     *
     * @param string|\Stringable $csrfToken The CSRF-token attribute value.
     * @param string $csrfName The CSRF-token attribute name.
     *
     * @return static A new instance of the current class with the specified csrf token, and csrf name.
     */
    public function csrf(string|\Stringable $csrfToken, string $csrfName = '_csrf'): static
    {
        $new = clone $this;
        $new->csrfToken = (string) $csrfToken;
        $new->csrfName = $csrfName;

        if ($new->csrfToken !== '') {
            $new->attributes[$new->csrfName] = $new->csrfToken;
        }

        return $new;
    }

    /**
     * Set the enctype content attribute specifies the content type of the form submission.
     *
     * @param string $value The enctype attribute value.
     *
     * @throws \InvalidArgumentException If the value is not one of: "multipart/form-data",
     * "application/x-www-form-urlencoded", "text/plain".
     *
     * @return static A new instance of the current class with the specified enctype value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-enctype
     */
    public function enctype(string $value): static
    {
        Validator::inList(
            $value,
            'Invalid value "%s" for the enctype attribute. Allowed values are: "%s".',
            'multipart/form-data',
            'application/x-www-form-urlencoded',
            'text/plain'
        );

        $new = clone $this;
        $new->attributes['enctype'] = $value;

        return $new;
    }

    /**
     * Set the method attribute specify how the form-data should be submitted.
     *
     * @param string $value The method attribute value.
     *
     * @return static A new instance of the current class with the specified method value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-method
     */
    public function method(string $value): static
    {
        $new = clone $this;
        $new->attributes['method'] = strtoupper($value);

        return $new;
    }

    /**
     * If present, they indicate that the form isn't to be validated during submission.
     *
     * @return static A new instance of the current class with the specified novalidate attribute.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-novalidate
     */
    public function noValidate(): static
    {
        $new = clone $this;
        $new->attributes['novalidate'] = true;

        return $new;
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        if ($this->isBeginExecuted() === false) {
            $hiddenInputs = $this->renderHiddenInput();

            $html = '';

            if ($hiddenInputs !== '') {
                $html = "$hiddenInputs\n";
            }

            return HTMLBuilder::createTag('form', $html . $this->content, $this->attributes);
        }

        return HTMLBuilder::endTag('form');
    }

    private function renderHiddenInput(): string
    {
        /** @var string $action */
        $action = $this->attributes['action'] ?? '';
        $hiddenInputs = [];
        $method = $this->attributes['method'] ?? '';

        if ($this->csrfToken !== '' && $method === 'POST') {
            $hiddenInputs[] = Hidden::widget()->id(null)->name($this->csrfName)->value($this->csrfToken)->render();
        }

        if ($method === 'GET' && ($pos = strpos($action, '?')) !== false) {
            /**
             * Query parameters in the action are ignored for GET method we use hidden fields to add them back.
             */
            foreach (explode('&', substr($action, $pos + 1)) as $pair) {
                $pos1 = strpos($pair, '=');

                if ($pos1 !== false) {
                    $hiddenInputs[] = Hidden::widget()
                        ->id(null)
                        ->name(urldecode(substr($pair, 0, $pos1)))
                        ->value(urldecode(substr($pair, $pos1 + 1)))
                        ->render();
                } else {
                    $hiddenInputs[] = Hidden::widget()->id(null)->name(urldecode($pair))->render();
                }
            }

            $this->attributes['action'] = substr($action, 0, $pos);
        }

        return $hiddenInputs !== [] ? implode(PHP_EOL, $hiddenInputs) : '';
    }
}
