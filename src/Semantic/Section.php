<?php

declare(strict_types=1);

namespace UIAwesome\Html\Semantic;

use UIAwesome\Html\Core\Base\AbstractBlockElement;

/**
 * The `<section>` HTML element represents a generic standalone section of a document, which doesn't have a more
 * specific semantic element to represent it. Sections should always have a heading, with very few exceptions.
 *
 * @link https://html.spec.whatwg.org/multipage/sections.html#the-section-element
 */
final class Section extends AbstractBlockElement
{
    protected string $tagName = 'section';
}
