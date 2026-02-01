<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{
    HasAs,
    HasBlocking,
    HasCrossorigin,
    HasDisabled,
    HasFetchpriority,
    HasHreflang,
    HasImagesizes,
    HasImagesrcset,
    HasIntegrity,
    HasMedia,
    HasReferrerpolicy,
    HasRel,
    HasSizes,
    HasType,
};
use UIAwesome\Html\Attribute\Element\HasHref;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{MetadataVoid, VoidInterface};

/**
 * Represents the HTML `<link>` element for specifying relationships between the current document and external
 * resources.
 *
 * Provides a concrete `<link>` element implementation that returns `MetadataVoid::LINK` and inherits void-level
 * rendering and global attribute support from {@see BaseVoid}.
 *
 * The `<link>` element is a void element commonly used to link stylesheets, preloads, icons, and other resources.
 *
 * It supports a wide range of attributes to define resource type, relationship, and loading behavior.
 *
 * Key features.
 * - Integrates with global and metadata-specific attributes.
 * - Suitable for stylesheets, preloads, icons, and alternate resources.
 * - Supports link-specific attributes via helper methods (`rel`, `href`, `as`, `blocking`, `crossorigin`, etc.).
 * - Void element renders without an end tag.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Link;
 *
 * echo Link::tag()
 *     ->rel('stylesheet')
 *     ->href('/css/site.css')
 *     ->render();
 * echo Link::tag()
 *     ->rel('preload')
 *     ->href('/fonts/font.woff2')
 *     ->as('font')
 *     ->type('font/woff2')
 *     ->crossorigin('anonymous')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Link extends BaseVoid
{
    use HasAs;
    use HasBlocking;
    use HasCrossorigin;
    use HasDisabled;
    use HasFetchpriority;
    use HasHref;
    use HasHreflang;
    use HasImagesizes;
    use HasImagesrcset;
    use HasIntegrity;
    use HasMedia;
    use HasReferrerpolicy;
    use HasRel;
    use HasSizes;
    use HasType;

    /**
     * Returns the tag enumeration for the `<link>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<link>`.
     *
     * {@see MetadataVoid} for valid metadata void tags.
     */
    protected function getTag(): VoidInterface
    {
        return MetadataVoid::LINK;
    }
}
