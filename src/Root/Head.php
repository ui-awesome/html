<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Root;

/**
 * Renders the HTML `<head>` element for document metadata.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Head::tag()
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/head
 * {@see BaseBlock} for the base implementation.
 */
final class Head extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<head>` element.
     *
     * @return Root Tag enumeration instance for `<head>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): Root
    {
        return Root::HEAD;
    }
}
