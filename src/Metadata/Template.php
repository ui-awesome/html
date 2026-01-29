<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{
    HasShadowRootClonable,
    HasShadowRootDelegatesFocus,
    HasShadowRootMode,
    HasShadowRootReferenceTarget,
    HasShadowRootSerializable,
};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};

/**
 * Represents the HTML `<template>` element for inert HTML fragments.
 *
 * Provides a concrete `<template>` element implementation that returns `MetadataBlock::TEMPLATE` and inherits
 * block-level rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<template>` element is used to hold HTML fragments for later use.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports `shadowroot*` attributes via helper methods.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Template;
 *
 * echo Template::tag()
 *     ->id('productrow')
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
    use HasShadowRootClonable;
    use HasShadowRootDelegatesFocus;
    use HasShadowRootMode;
    use HasShadowRootReferenceTarget;
    use HasShadowRootSerializable;
    /**
     * Returns the tag enumeration for the `<template>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<template>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::TEMPLATE;
    }
}
