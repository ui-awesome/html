<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\{HasCrossorigin, HasFetchpriority, HasSizes};
use UIAwesome\Html\Attribute\Values\{Decoding, ElementAttribute, Loading, Referrerpolicy};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<img>` element for embedding images.
 *
 * Supports the experimental `elementtiming` attribute. Availability and behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Img::tag()
 *     ->alt('A beautiful landscape')
 *     ->height(600)
 *     ->loading('lazy')
 *     ->src('image.jpg')
 *     ->width(800)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Img extends BaseVoid
{
    use HasCrossorigin;
    use HasFetchpriority;
    use HasSizes;

    /**
     * Sets the `alt` attribute.
     *
     * Usage example:
     * ```php
     * $element->alt('A penguin on a beach.');
     * $element->alt('');
     * $element->alt(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Alternative text for the element, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `alt` attribute.
     */
    public function alt(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::ALT, $value);
    }

    /**
     * Sets the `decoding` attribute.
     *
     * Usage example:
     * ```php
     * $element->decoding('async');
     * $element->decoding(Decoding::ASYNC);
     * $element->decoding(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Decoding hint value. Use 'async', 'sync', or 'auto', or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException If the value is not valid.
     *
     * @return static New instance with the updated `decoding` attribute.
     *
     * {@see Decoding} for predefined enum values.
     */
    public function decoding(string|Stringable|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Decoding::cases(), ElementAttribute::DECODING);

        return $this->addAttribute(ElementAttribute::DECODING, $value);
    }

    /**
     * Sets the `elementtiming` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Img::tag()
     *     ->elementtiming('hero-image')
     *     ->render();
     * echo \UIAwesome\Html\Embedded\Img::tag()
     *     ->elementtiming('product-thumbnail')
     *     ->render();
     * echo \UIAwesome\Html\Embedded\Img::tag()
     *     ->elementtiming(null)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Element timing identifier, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `elementtiming` attribute.
     */
    public function elementtiming(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('elementtiming', $value);
    }

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
     * Sets the `ismap` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Img::tag()
     *     ->ismap(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether the image is a server-side image map.
     *
     * @return static New instance with the updated `ismap` attribute.
     */
    public function ismap(bool $value): static
    {
        return $this->addAttribute('ismap', $value);
    }

    /**
     * Sets the `loading` attribute.
     *
     * Usage example:
     * ```php
     * $element->loading('lazy');
     * $element->loading(Loading::LAZY);
     * $element->loading(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Loading strategy ('eager' or 'lazy'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException If the value is not valid.
     *
     * @return static New instance with the updated `loading` attribute.
     *
     * {@see Loading} for predefined enum values.
     */
    public function loading(string|Stringable|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Loading::cases(), ElementAttribute::LOADING);

        return $this->addAttribute(ElementAttribute::LOADING, $value);
    }

    /**
     * Sets the `referrerpolicy` attribute.
     *
     * Usage example:
     * ```php
     * $element->referrerpolicy('origin');
     * $element->referrerpolicy(Referrerpolicy::NO_REFERRER);
     * $element->referrerpolicy(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Referrer policy token, or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException If the value is not valid.
     *
     * @return static New instance with the updated `referrerpolicy` attribute.
     *
     * {@see Referrerpolicy} for predefined enum values.
     */
    public function referrerpolicy(string|Stringable|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Referrerpolicy::cases(), ElementAttribute::REFERRERPOLICY);

        return $this->addAttribute(ElementAttribute::REFERRERPOLICY, $value);
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
     * Sets the `usemap` attribute.
     *
     * Usage example:
     * ```php
     * $element->usemap('#imagemap');
     * $element->usemap(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Hash-name reference to a `map` element, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `usemap` attribute.
     */
    public function usemap(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::USEMAP, $value);
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
     * Returns the tag enumeration for the `<img>` element.
     *
     * @return Voids Tag enumeration instance for `<img>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::IMG;
    }
}
