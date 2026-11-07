<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\{HasCrossorigin, HasFetchpriority, HasSizes};
use UIAwesome\Html\Attribute\Values\{Attribute, Decoding, ElementAttribute, Loading, Referrerpolicy};
use UIAwesome\Html\Contracts\Attribute\SrcInterface;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<img>` element for embedding images.
 *
 * Supports the experimental `elementtiming` attribute. Availability and behavior may vary across browsers.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img
 * {@see BaseVoid} for the base implementation.
 */
final class Img extends BaseVoid implements SrcInterface
{
    use HasCrossorigin;
    use HasFetchpriority;
    use HasSizes;

    /**
     * Sets the `alt` attribute.
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
        Validator::oneOf($value, Referrerpolicy::cases(), Attribute::REFERRERPOLICY);

        return $this->addAttribute(Attribute::REFERRERPOLICY, $value);
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
     * Sets the `usemap` attribute.
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
