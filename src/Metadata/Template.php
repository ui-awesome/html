<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\MetadataBlock;
use UIAwesome\Html\Metadata\Attribute\{
    HasShadowRootClonable,
    HasShadowRootDelegatesFocus,
    HasShadowRootMode,
    HasShadowRootReferenceTarget,
    HasShadowRootSerializable,
};

/**
 * Renders the HTML `<template>` element for inert HTML fragments.
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
    use HasShadowRootClonable;
    use HasShadowRootDelegatesFocus;
    use HasShadowRootMode;
    use HasShadowRootReferenceTarget;
    use HasShadowRootSerializable;

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
