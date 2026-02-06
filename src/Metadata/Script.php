<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{
    HasBlocking,
    HasCrossorigin,
    HasFetchpriority,
    HasIntegrity,
    HasReferrerpolicy,
    HasSrc,
    HasType,
};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};
use UIAwesome\Html\Metadata\Attribute\{HasAsync, HasDefer, HasNomodule};

/**
 * Renders the HTML `<script>` element for executable code or data blocks.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Script::tag()
 *     ->src('https://example.com/app.js')
 *     ->async(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Script extends BaseBlock
{
    use HasAsync;
    use HasBlocking;
    use HasCrossorigin;
    use HasDefer;
    use HasFetchpriority;
    use HasIntegrity;
    use HasNomodule;
    use HasReferrerpolicy;
    use HasSrc;
    use HasType;

    /**
     * Returns the tag enumeration for the `<script>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<script>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::SCRIPT;
    }
}
