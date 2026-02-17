<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{HasCharset, HasContent, HasHttpEquiv, HasMedia, HasName};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{MetadataVoid, VoidInterface};

/**
 * Renders the HTML `<meta>` element for document metadata.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Meta::tag()
 *     ->content('width=device-width, initial-scale=1')
 *     ->name('viewport')
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
