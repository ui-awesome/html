<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use Stringable;
use UIAwesome\Html\Attribute\{HasMedia, HasSizes};
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<source>` element for media and responsive image sources.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Source::tag()
 *     ->src('/media/intro.webm')
 *     ->type('video/webm')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/source
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Source extends BaseVoid
{
    use HasMedia;
    use HasSizes;

    /**
     * Sets the `height` attribute.
     *
     * Usage example:
     * ```php
     * $element->height(200);
     * $element->height('50%');
     * $element->height('auto');
     * ```
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
     * Usage example:
     * ```php
     * $element->src('https://example.com/image.png');
     * $element->src('images/photo.jpg');
     * $element->src(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Image source URL or path, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `src` attribute.
     */
    public function src(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::SRC, $value);
    }

    /**
     * Sets the `srcset` attribute.
     *
     * Usage example:
     * ```php
     * $element->srcset('small.jpg 480w, medium.jpg 800w, large.jpg 1200w');
     * $element->srcset('image-1x.jpg 1x, image-2x.jpg 2x');
     * $element->srcset(null);
     * ```
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
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Source::tag()
     *     ->type('video/webm')
     *     ->render();
     * ```
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
     * Usage example:
     * ```php
     * $element->width(400);
     * $element->width('50%');
     * $element->width('auto');
     * $element->width(null);
     * ```
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
