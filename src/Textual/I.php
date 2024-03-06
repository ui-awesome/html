<?php

declare(strict_types=1);

namespace UIAwesome\Html\Textual;

use UIAwesome\Html\{Base\AbstractElement, Concern\HasContent};

/**
 * The `<i>` HTML element represents a range of text that's set off from the normal text for some reason, such as
 * an idiomatic text, technical terms, taxonomic designations, among others.
 *
 * @link https://html.spec.whatwg.org/multipage/text-level-semantics.html#the-i-element
 */
final class I extends AbstractElement
{
    use HasContent;

    protected function run(): string
    {
        return $this->buildElement('i', $this->content);
    }
}
