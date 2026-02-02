<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};

/**
 * Represents the HTML `<noscript>` element for fallback content when scripts are disabled.
 *
 * Provides a concrete `<noscript>` element implementation that returns `MetadataBlock::NOSCRIPT` and inherits
 * block-level rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<noscript>` element defines a section of HTML to be inserted if a script type on the page is unsupported or if
 * scripting is currently turned off in the browser. When scripting is disabled, the element represents its children as
 * HTML content. When scripting is enabled, the element represents its children as text.
 *
 * Key features.
 * - Can be used in `<head>` (with link, style, meta) or in body (with transparent content).
 * - Container element accepts child content for fallback scenarios.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\NoScript;
 *
 * echo NoScript::tag()
 *     ->content('Please enable JavaScript to use this application.')
 *     ->render();
 * echo NoScript::tag()
 *     ->html('<link rel="stylesheet" href="noscript.css">')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/noscript
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class NoScript extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<noscript>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<noscript>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::NOSCRIPT;
    }
}
