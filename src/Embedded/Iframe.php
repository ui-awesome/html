<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, Loading, Referrerpolicy};
use UIAwesome\Html\Contracts\Attribute\SrcInterface;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Block;
use UnitEnum;

/**
 * Renders the HTML `<iframe>` element for embedding a nested browsing context.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/iframe
 * {@see BaseBlock} for the base implementation.
 */
final class Iframe extends BaseBlock implements SrcInterface
{
    /**
     * Sets the `allow` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Permissions Policy applied to the embedded content, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `allow` attribute.
     */
    public function allow(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('allow', $value);
    }

    /**
     * Sets the `allowfullscreen` attribute.
     *
     * @param bool $value Whether the embedded content can activate fullscreen mode.
     *
     * @return static New instance with the updated `allowfullscreen` attribute.
     */
    public function allowfullscreen(bool $value): static
    {
        return $this->addAttribute('allowfullscreen', $value);
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
     * Sets the `loading` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Loading strategy ('eager' or 'lazy'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the value is not valid.
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
     * Sets the `name` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Targetable name for the embedded browsing context, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `name` attribute.
     */
    public function name(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::NAME, $value);
    }

    /**
     * Sets the `referrerpolicy` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Referrer policy token, or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the value is not valid.
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
     * Sets the `sandbox` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Space-separated restriction tokens, an empty string to apply all
     * restrictions, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `sandbox` attribute.
     */
    public function sandbox(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('sandbox', $value);
    }

    /**
     * Sets the `src` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value URL of the page to embed, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `src` attribute.
     */
    public function src(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::SRC, $value);
    }

    /**
     * Sets the `srcdoc` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Inline HTML to embed in place of the `src` attribute, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `srcdoc` attribute.
     */
    public function srcdoc(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('srcdoc', $value);
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
     * Returns the tag enumeration for the `<iframe>` element.
     *
     * @return Block Tag enumeration instance for `<iframe>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::IFRAME;
    }
}
