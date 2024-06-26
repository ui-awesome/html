<?php

declare(strict_types=1);

namespace UIAwesome\Html\Document;

use UIAwesome\Html\Core\Base\AbstractBlockElement;

/**
 * The `<body>` `HTML` element represents the content of an HTML document.
 * There can be only one `<body>` element in a document.
 *
 * @link https://html.spec.whatwg.org/multipage/sections.html#the-body-element
 */
final class Body extends AbstractBlockElement
{
    protected string $tagName = 'body';
}
