<?php

declare(strict_types=1);

namespace UIAwesome\Html\Multimedia;

use UIAwesome\Html\{
    Attribute\HasAlt,
    Attribute\HasHeight,
    Attribute\HasReferrerpolicy,
    Attribute\HasSrc,
    Attribute\HasWidth,
    Base\AbstractElement,
    Helper\Validator
};

/**
 * The `<img>` HTML element embeds an image into the document.
 *
 * @link https://html.spec.whatwg.org/multipage/embedded-content.html#the-img-element
 */
final class Img extends AbstractElement
{
    use HasAlt;
    use HasHeight;
    use HasReferrerpolicy;
    use HasSrc;
    use HasWidth;

    /**
     * Set the crossorigin.
     *
     * Image data from a CORS-enabled image returned from a CORS request can be reused in the `<canvas>` element without
     * being marked "tainted".
     *
     * @param string $value The crossorigin value.
     *
     * @throws \InvalidArgumentException If the value is not one of: "anonymous", "use-credentials".
     *
     * @return static A new instance of the current class with the specified crossorigin value.
     *
     * @link https://html.spec.whatwg.org/multipage/urls-and-fetching.html#cors-settings-attributes
     */
    public function crossorigin(string $value): static
    {
        Validator::inList(
            $value,
            'Invalid value "%s" for the crossorigin attribute. Allowed values are: "%s".',
            'anonymous',
            'use-credentials'
        );

        $new = clone $this;
        $new->attributes['crossorigin'] = $value;

        return $new;
    }

    /**
     * Set the image is a server-side image map.
     *
     * If so, the coordinates where the user clicked on the image are sent to the server.
     *
     * @return static A new instance of the current class with the specified ismap value.
     *
     * @link https://html.spec.whatwg.org/multipage/embedded-content.html#attr-img-ismap
     */
    public function ismap(): static
    {
        $new = clone $this;
        $new->attributes['ismap'] = true;

        return $new;
    }

    /**
     * Specifying when the browser should load the image.
     *
     * @param string $value The loading value.
     *
     * @throws \InvalidArgumentException If the value is not one of: "eager", "lazy".
     *
     * @return static A new instance of the current class with the specified loading value.
     */
    public function loading(string $value): static
    {
        Validator::inList(
            $value,
            'Invalid value "%s" for the loading attribute. Allowed values are: "%s".',
            'eager',
            'lazy'
        );

        $new = clone $this;
        $new->attributes['loading'] = $value;

        return $new;
    }

    /**
     * Set one or more strings separated by commas, indicating a set of source sizes.
     *
     * @param string ...$value The sizes attribute.
     *
     * @return static A new instance of the current class with the specified sizes value.
     *
     * @link https://www.w3.org/TR/html52/embedded-content-0.html#attr-img-sizes
     */
    public function sizes(string ...$value): static
    {
        $new = clone $this;
        $new->attributes['sizes'] = implode(', ', $value);

        return $new;
    }

    /**
     * Set one or more strings separated by commas, indicating possible image sources for the user agent to use.
     *
     * @param string ...$value The source set of the widget.
     *
     * @return static A new instance of the current class with the specified srcset value.
     *
     * @link https://www.w3.org/TR/html52/embedded-content-0.html#attr-img-srcset
     */
    public function srcset(string ...$value): static
    {
        $new = clone $this;
        $new->attributes['srcset'] = implode(', ', $value);

        return $new;
    }

    protected function run(): string
    {
        return $this->buildElement('img');
    }
}
