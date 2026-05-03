<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use Stringable;
use UIAwesome\Html\Attribute\HasTarget;
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\MetadataVoid;
use UnitEnum;

/**
 * Renders the HTML `<base>` element for the document base URL and default navigation target.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Base::tag()
 *     ->href('https://example.com/')
 *     ->target('_blank')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/base
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Base extends BaseVoid
{
    use HasTarget;

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
     * Returns the tag enumeration for the `<base>` element.
     *
     * @return MetadataVoid Tag enumeration instance for `<base>`.
     *
     * {@see MetadataVoid} for valid metadata void tags.
     */
    protected function getTag(): MetadataVoid
    {
        return MetadataVoid::BASE;
    }
}
