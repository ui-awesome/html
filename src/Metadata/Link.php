<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use Stringable;
use UIAwesome\Html\Attribute\{
    CanBeDisabled,
    HasAs,
    HasBlocking,
    HasCrossorigin,
    HasFetchpriority,
    HasHreflang,
    HasImageSizes,
    HasImageSrcSet,
    HasIntegrity,
    HasMedia,
    HasReferrerpolicy,
    HasRel,
    HasSizes,
    HasType,
};
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\MetadataVoid;
use UnitEnum;

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
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/link
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
    use HasHreflang;
    use HasImageSizes;
    use HasImageSrcSet;
    use HasIntegrity;
    use HasMedia;
    use HasReferrerpolicy;
    use HasRel;
    use HasSizes;
    use HasType;

    /**
     * Sets the `href` attribute.
     *
     * Usage example:
     * ```php
     * $element->href('https://example.com/page');
     * $element->href('/about');
     * $element->href('#section');
     * $element->href(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value URL, path, or fragment, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `href` attribute.
     */
    public function href(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::HREF, $value);
    }

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
