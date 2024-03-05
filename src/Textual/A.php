<?php

declare(strict_types=1);

namespace UIAwesome\Html\Textual;

use UIAwesome\Html\{
    Attribute\Aria\HasAriaControls,
    Attribute\Aria\HasAriaDisabled,
    Attribute\Aria\HasAriaExpanded,
    Attribute\Aria\HasAriaLabel,
    Attribute\Aria\HasRole,
    Attribute\CanBeAutofocus,
    Attribute\CanBeHidden,
    Attribute\HasReferrerpolicy,
    Attribute\HasRel,
    Attribute\HasTabindex,
    Attribute\HasType,
    Base\AbstractElement,
    Concern\HasContent,
    Helper\Validator
};

/**
 * The `<a>` `HTML` element (or anchor element), with its href attribute, creates a hyperlink to web pages, files, email
 * addresses, locations in the same page, or anything else a URL can address.
 *
 * @link https://html.spec.whatwg.org/multipage/text-level-semantics.html#the-a-element
 */
final class A extends AbstractElement
{
    use CanBeAutofocus;
    use CanBeHidden;
    use HasAriaControls;
    use HasAriaDisabled;
    use HasAriaExpanded;
    use HasAriaLabel;
    use HasContent;
    use HasReferrerpolicy;
    use HasRel;
    use HasRole;
    use HasTabindex;
    use HasType;

    /**
     * Set the hyperlink is to be used for downloading a resource.
     *
     * @return static A new instance of the current class with the specified download value.
     *
     * @link https://html.spec.whatwg.org/multipage/links.html#attr-hyperlink-download
     */
    public function download(): static
    {
        $new = clone $this;
        $new->attributes['download'] = true;

        return $new;
    }

    /**
     * Set the URL that the hyperlink points to.
     *
     * Links aren't restricted to HTTP-based URLs they can use any URL scheme supported by browsers.
     *
     * @param string $value The URL that the hyperlink points to.
     *
     * @return static A new instance of the current class with the specified href value.
     *
     * @link https://html.spec.whatwg.org/multipage/links.html#ping
     */
    public function href(string $value): static
    {
        $new = clone $this;
        $new->attributes['href'] = $value;

        return $new;
    }

    /**
     * Set the language of the linked resource.
     *
     * @param string $value The language of the linked resource.
     *
     * @return static A new instance of the current class with the specified hreflang value.
     *
     * @link https://html.spec.whatwg.org/multipage/links.html#attr-hyperlink-hreflang
     * @link https://www.w3schools.com/tags/ref_language_codes.asp
     */
    public function hreflang(string $value): static
    {
        $new = clone $this;
        $new->attributes['hreflang'] = $value;

        return $new;
    }

    /**
     * Set a space-separated list of URLs.
     *
     * When the link is followed, the browser will send POST requests with the body PING to the URLs.
     *
     * Typically, for tracking.
     *
     * @param string $value A space-separated list of URLs.
     *
     * @return static A new instance of the current class with the specified ping value.
     *
     * @link https://html.spec.whatwg.org/multipage/links.html#attr-hyperlink-ping
     */
    public function ping(string $value): static
    {
        $new = clone $this;
        $new->attributes['ping'] = $value;

        return $new;
    }

    /**
     * Set the target attributes, if specified, must have values that are valid browsing context names or keywords.
     *
     * @param string $value The target attribute value.
     *
     * @throws \InvalidArgumentException If the target value is not one of the allowed values. Allowed values are:
     * `_blank`, `_self`, `_parent`, `_top`.
     *
     * @return static A new instance of the current class with the specified target value.
     *
     * @link https://html.spec.whatwg.org/multipage/links.html#attr-hyperlink-target
     */
    public function target(string $value): static
    {
        Validator::inList(
            $value,
            'Invalid value "%s" for the target attribute. Allowed values are: "%s".',
            '_blank',
            '_self',
            '_parent',
            '_top',
        );

        $new = clone $this;
        $new->attributes['target'] = $value;

        return $new;
    }

    protected function run(): string
    {
        return $this->buildElement('a', $this->content);
    }
}
