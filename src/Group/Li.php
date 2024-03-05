<?php

declare(strict_types=1);

namespace UIAwesome\Html\Group;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasStyle,
    Attribute\HasTabindex,
    Attribute\HasTitle,
    Attribute\HasType,
    Attribute\HasValue,
    Concern\HasAttributes,
    Interop\RenderInterface,
    Tag
};

use function trim;
/**
 * The `<li>` HTML element is used to represent an item in a list.
 * It must be contained in a parent element: an ordered list `<ol>`, an unordered list `<ul>`, or a menu `<menu>`.
 * In menus and unordered lists, list items are usually displayed using bullet points. In ordered lists, they are
 * usually displayed with an ascending counter on the left, such as a number or letter.
 *
 * @link https://html.spec.whatwg.org/multipage/grouping-content.html#the-li-element
 */
final class Li extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasId;
    use HasLang;
    use HasStyle;
    use HasTabindex;
    use HasTitle;
    use HasType;
    use HasValue;

    protected string $content = '';

    /**
     * Set the `HTML` content value.
     *
     * @param RenderInterface|string ...$values The `HTML` content value.
     *
     * @return static A new instance of the current class with the specified content value.
     */
    public function content(string|RenderInterface ...$values): static
    {
        $new = clone $this;

        foreach ($values as $value) {
            $new->content .= "$value\n";
        }

        return $new;
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        return Tag::widget()->attributes($this->attributes)->content(trim($this->content))->tagName('li')->render();
    }
}
