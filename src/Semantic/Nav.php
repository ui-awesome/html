<?php

declare(strict_types=1);

namespace UIAwesome\Html\Semantic;

use UIAwesome\Html\Core\Base\AbstractBlockElement;

/**
 * The `<nav>` HTML element represents a section of a page whose purpose is to provide navigation links, either within
 * the current document or to other documents. Common examples of navigation sections are menus, tables of contents,
 * and indexes.
 *
 * @link https://html.spec.whatwg.org/multipage/sections.html#the-nav-element
 */
final class Nav extends AbstractBlockElement
{
    protected string $tagName = 'nav';
}
