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
 * Represents the HTML `<script>` element for embedding executable code.
 *
 * Provides a concrete `<script>` element implementation that returns `MetadataBlock::SCRIPT` and inherits block-level
 * rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<script>` element is used to embed executable code or data, typically JavaScript.
 *
 * Key features.
 * - Container element accepts child content for inline scripts.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 * - Supports script-specific attributes via helper methods (`async`, `defer`, `nomodule`, `src`, `type`, etc.).
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Script;
 *
 * echo Script::tag()
 *     ->src('https://example.com/app.js')
 *     ->async(true)
 *     ->render();
 * echo Script::tag()
 *     ->content('console.log("Hello World!");')
 *     ->render();
 * echo Script::tag()
 *     ->src('https://example.com/module.js')
 *     ->type('module')
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
