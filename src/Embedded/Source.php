<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use Stringable;
use UIAwesome\Html\Attribute\{HasMedia, HasSizes};
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute};
use UIAwesome\Html\Contracts\Attribute\SrcInterface;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<source>` element for media and responsive image sources.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/source
 * {@see BaseVoid} for the base implementation.
 */
final class Source extends BaseVoid implements SrcInterface
{
    use HasMedia;
    use HasSizes;

    /**
     * Sets the `height` attribute.
     *
     * @param int|string|Stringable|UnitEnum|null $value Height value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `height` attribute.
     */
    public function height(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::HEIGHT, $value);
    }

    /**
     * Sets the `src` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Image source URL or path, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `src` attribute.
     */
    public function src(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::SRC, $value);
    }

    /**
     * Sets the `srcset` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Comma-separated image URLs with size descriptors, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `srcset` attribute.
     */
    public function srcset(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('srcset', $value);
    }

    /**
     * Sets the `type` attribute.
     *
     * @param string|UnitEnum|null $value Resource MIME type, optionally including a codecs parameter, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `type` attribute.
     */
    public function type(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('type', $value);
    }

    /**
     * Sets the `width` attribute.
     *
     * @param int|string|Stringable|UnitEnum|null $value Width value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `width` attribute.
     */
    public function width(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::WIDTH, $value);
    }

    /**
     * Returns the tag enumeration for the `<source>` element.
     *
     * @return Voids Tag enumeration instance for `<source>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::SOURCE;
    }
}
