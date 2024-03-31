<?php

declare(strict_types=1);

namespace UIAwesome\Html\Group;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\FormControl\HasSize,
    Attribute\HasClass,
    Attribute\HasWidth,
    Concern\HasAttributes,
    Core\HTMLBuilder,
    Interop\RenderInterface
};

/**
 * The `<hr>` `HTML` element represents a thematic break between paragraph-level elements: for example, a change of
 * scene in a story, or a shift of topic within a section.
 *
 * @link https://html.spec.whatwg.org/multipage/grouping-content.html#the-hr-element
 */
final class Hr extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasSize;
    use HasWidth;

    protected array $attributes = [];

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        return HTMLBuilder::createTag('hr', '', $this->attributes);
    }
}
