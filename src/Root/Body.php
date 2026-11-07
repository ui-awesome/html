<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Root;

/**
 * Renders the HTML `<body>` element for document content.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/body
 * {@see BaseBlock} for the base implementation.
 */
final class Body extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<body>` element.
     *
     * @return Root Tag enumeration instance for `<body>`.
     *
     * {@see Root} for valid root-level tags.
     */
    protected function getTag(): Root
    {
        return Root::BODY;
    }
}
