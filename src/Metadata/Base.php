<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\Element\HasHref;
use UIAwesome\Html\Attribute\HasTarget;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{MetadataVoid, VoidInterface};

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
