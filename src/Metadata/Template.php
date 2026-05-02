<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\MetadataBlock;
use UIAwesome\Html\Metadata\Values\ShadowRootMode;
use UnitEnum;

/**
 * Renders the HTML `<template>` element for inert HTML fragments.
 *
 * Supports experimental declarative shadow DOM attributes. Availability and behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Template::tag()
 *     ->html('<tr><td></td></tr>')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Template extends BaseBlock
{
    /**
     * Sets the `shadowrootclonable` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootClonable(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow cloning the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootclonable` attribute.
     */
    public function shadowRootClonable(bool $value): static
    {
        return $this->addAttribute('shadowrootclonable', $value);
    }

    /**
     * Sets the `shadowrootdelegatesfocus` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootDelegatesFocus(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to delegate focus into the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootdelegatesfocus` attribute.
     */
    public function shadowRootDelegatesFocus(bool $value): static
    {
        return $this->addAttribute('shadowrootdelegatesfocus', $value);
    }

    /**
     * Sets the `shadowrootmode` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootMode(\UIAwesome\Html\Metadata\Values\ShadowRootMode::OPEN)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Shadow root mode ('open' or 'closed'), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `shadowrootmode` attribute.
     *
     * {@see ShadowRootMode} for predefined enum values.
     */
    public function shadowRootMode(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, ShadowRootMode::cases(), 'shadowrootmode');

        return $this->addAttribute('shadowrootmode', $value);
    }

    /**
     * Sets the `shadowrootreferencetarget` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootReferenceTarget('dialog-title')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Reference target ID, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `shadowrootreferencetarget` attribute.
     */
    public function shadowRootReferenceTarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('shadowrootreferencetarget', $value);
    }

    /**
     * Sets the `shadowrootserializable` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootSerializable(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow serializing the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootserializable` attribute.
     */
    public function shadowRootSerializable(bool $value): static
    {
        return $this->addAttribute('shadowrootserializable', $value);
    }

    /**
     * Returns the tag enumeration for the `<template>` element.
     *
     * @return MetadataBlock Tag enumeration instance for `<template>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): MetadataBlock
    {
        return MetadataBlock::TEMPLATE;
    }
}
