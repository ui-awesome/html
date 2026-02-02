<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\Element\HasHref;
use UIAwesome\Html\Attribute\HasTarget;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{MetadataVoid, VoidInterface};

/**
 * Represents the HTML `<base>` element for specifying the base URL and default target for relative URLs in a document.
 *
 * Provides a concrete `<base>` element implementation that returns `MetadataVoid::BASE` and inherits void-level
 * rendering and global attribute support from {@see BaseVoid}.
 *
 * The `<base>` element sets the base URL for all relative URLs and can specify a default target for hyperlinks and
 * forms. Only one `<base>` element is permitted per document, and it must appear inside the `<head>` element before any
 * other elements with URL attributes.
 *
 * Key features.
 * - Must be placed before other URL-dependent elements in `<head>`.
 * - Only one `<base>` element allowed per document.
 * - Supports base-specific attributes via helper methods (`href`, `target`).
 * - Void element renders without end tag.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Base;
 *
 * echo Base::tag()
 *     ->href('https://example.com/')
 *     ->render();
 * echo Base::tag()
 *     ->href('https://example.com/')
 *     ->target('_blank')
 *     ->render();
 * echo Base::tag()
 *     ->href('/assets/')
 *     ->target(Target::BLANK)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/base
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Base extends BaseVoid
{
    use HasHref;
    use HasTarget;

    /**
     * Returns the tag enumeration for the `<base>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<base>`.
     *
     * {@see MetadataVoid} for valid metadata void tags.
     */
    protected function getTag(): VoidInterface
    {
        return MetadataVoid::BASE;
    }
}
