<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Attribute\Global\HasNonce;
use UIAwesome\Html\Attribute\{HasBlocking, HasMedia, HasType};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\MetadataBlock;

/**
 * Renders the HTML `<style>` element for embedded CSS rules.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Metadata\Style::tag()
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
     * @return MetadataBlock Tag enumeration instance for `<style>`.
     *
     * {@see MetadataBlock} for valid metadata block-level tags.
     */
    protected function getTag(): MetadataBlock
    {
        return MetadataBlock::STYLE;
    }
}
