<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{HasCharset, HasContent, HasHttpEquiv, HasMedia, HasName};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{MetadataVoid, VoidInterface};

/**
 * Represents the HTML `<meta>` element for document metadata.
 *
 * Provides a concrete `<meta>` element implementation that returns `MetadataVoid::META` and inherits void-level
 * rendering and global attribute support from {@see BaseVoid}.
 *
 * The `<meta>` element represents metadata that cannot be represented by other meta-related elements. The type of
 * metadata can be document-level metadata (with `name`), pragma directives (with `http-equiv`), charset declarations
 * (with `charset`), or user-defined metadata (with `itemprop`).
 *
 * Key features.
 * - Supports `charset` attribute for character encoding declarations.
 * - Supports `name` and `content` attributes for document-level metadata.
 * - Supports `http-equiv` and `content` attributes for pragma directives.
 * - Supports `media` attribute for theme-color metadata.
 * - Void element renders without end tag.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Meta;
 *
 * echo Meta::tag()
 *     ->charset('utf-8')
 *     ->render();
 * echo Meta::tag()
 *     ->name('viewport')
 *     ->content('width=device-width, initial-scale=1')
 *     ->render();
 * echo Meta::tag()
 *     ->name('description')
 *     ->content('A description of the page')
 *     ->render();
 * echo Meta::tag()
 *     ->httpEquiv('refresh')
 *     ->content('3;url=https://example.com')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Meta extends BaseVoid
{
    use HasCharset;
    use HasContent;
    use HasHttpEquiv;
    use HasMedia;
    use HasName;

    /**
     * Returns the tag enumeration for the `<meta>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<meta>`.
     *
     * {@see MetadataVoid} for valid metadata void tags.
     */
    protected function getTag(): VoidInterface
    {
        return MetadataVoid::META;
    }
}
