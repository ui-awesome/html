<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Root;

/**
 * Renders the HTML `<html>` element as the document root.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Html::tag()
 *     ->content('value')
 *     ->lang('en')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/html
 * {@see BaseBlock} for the base implementation.
 */
final class Html extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<html>` element.
     *
     * @return Root Tag enumeration instance for `<html>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): Root
    {
        return Root::HTML;
    }
}
