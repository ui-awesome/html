<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasName,
    Attribute\HasStyle,
    Concern\HasAttributes,
    Helper\Encode,
    Interop\RenderInterface,
    Tag
};

/**
 * The `<meta>` HTML element represents metadata that cannot be represented by other HTML meta-related elements,
 * like `<base>`, `<link>`, `<script>`, `<style>`, or `<title>`.
 *
 * @link https://html.spec.whatwg.org/multipage/semantics.html#the-meta-element
 */
final class Meta extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasId;
    use HasLang;
    use HasName;
    use HasStyle;

    /**
     * Set the character encoding of the linked resource.
     *
     * @param string $value The character encoding of the linked resource.
     *
     * @return static A new instance of the current class with the specified charset value.
     *
     * @link https://html.spec.whatwg.org/multipage/semantics.html#attr-link-charset
     */
    public function charset(string $value): static
    {
        $new = clone $this;
        $new->attributes['charset'] = Encode::content($value);

        return $new;
    }

    /**
     * Sets the content attributes.
     *
     * @param string $value The content value.
     *
     * @return static A new instance of the current class with the specified content value.
     */
    public function content(string $value): static
    {
        $new = clone $this;
        $new->attributes['content'] = Encode::content($value);

        return $new;
    }

    /**
     * Set the name of the HTTP header to define.
     *
     * @param string $value The name of the HTTP header to define.
     *
     * @return static A new instance of the current class with the specified http-equiv value.
     *
     * @link https://html.spec.whatwg.org/multipage/semantics.html#attr-meta-http-equiv
     */
    public function httpEquiv(string $value): static
    {
        $new = clone $this;
        $new->attributes['http-equiv'] = Encode::value($value);

        return $new;
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        return Tag::widget()->attributes($this->attributes)->tagName('meta')->render();
    }
}
