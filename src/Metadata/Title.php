<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata;

use UIAwesome\Html\Core\Base\AbstractBlockElement;

/**
 * The `<title>` HTML element defines the document's title shown in a browser's title bar or a page's tab.
 * It only contains text; tags within the element are ignored.
 *
 * @link https://html.spec.whatwg.org/multipage/semantics.html#the-title-element
 */
final class Title extends AbstractBlockElement
{
    protected string $tagName = 'title';
}
