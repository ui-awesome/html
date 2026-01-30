<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\{HasBlocking, HasMedia, HasType};
use UIAwesome\Html\Attribute\Global\HasNonce;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, MetadataBlock};

/**
 * Represents the HTML `<style>` element.
 *
 * Provides a concrete `<style>` element implementation that returns `MetadataBlock::STYLE` and inherits block-level
 * rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<style>` element contains style information for a document.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `<style>`-specific attributes via helper methods.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Metadata\Style;
 *
 * echo Style::tag()
 *     ->media('screen')
 *     ->content('body { color: red; }')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/style
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Style extends BaseBlock
{
    use HasBlocking;
    use HasMedia;
    use HasNonce;
    use HasType;

    /**
     * Returns the tag enumeration for the `<style>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<style>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return MetadataBlock::STYLE;
    }
}
