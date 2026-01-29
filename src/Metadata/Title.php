<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};

/**
 * Represents the HTML `<title>` element.
 *
 * Provides a concrete `<title>` element implementation that returns `MetadataBlock::TITLE` and inherits block-level
 * rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<title>` element defines the document's title shown in the browser's title bar or tab.
 *
 * Key features.
 * - Element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Title;
 *
 * echo Title::tag()
 *     ->content('My page')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/title
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Title extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<title>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<title>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::TITLE;
    }
}
