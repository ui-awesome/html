<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{
    CanBeDisabled,
    HasAs,
    HasBlocking,
    HasCrossorigin,
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
use UIAwesome\Html\Interop\MetadataVoid;

/**
 * Renders the HTML `<link>` element for relationships to external resources.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Link::tag()
 *     ->href('/css/site.css')
 *     ->rel('stylesheet')
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
    use CanBeDisabled;
    use HasAs;
    use HasBlocking;
    use HasCrossorigin;
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
     * @return MetadataVoid Tag enumeration instance for `<link>`.
     *
     * {@see MetadataVoid} for valid metadata void tags.
     */
    protected function getTag(): MetadataVoid
    {
        return MetadataVoid::LINK;
    }
}
