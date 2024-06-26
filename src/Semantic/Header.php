<?php

declare(strict_types=1);

namespace UIAwesome\Html\Semantic;

use UIAwesome\Html\Core\Base\AbstractBlockElement;

/**
 * The `<header>` HTML element represents introductory content, typically a group of introductory or navigational aids.
 * It may contain some heading elements but also a logo, a search form, an author name, and other elements.
 *
 * @link https://html.spec.whatwg.org/multipage/sections.html#the-header-element
 */
final class Header extends AbstractBlockElement
{
    protected string $tagName = 'header';
}
