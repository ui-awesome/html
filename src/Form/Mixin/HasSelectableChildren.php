<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use UIAwesome\Html\Form\{Optgroup, Option};
use UIAwesome\Html\Mixin\HasContent;

use function count;
use function sprintf;
use function strlen;
use function strtr;

/**
 * Provides deferred child rendering so the parent selection state applies at render time.
 *
 * Appending a child writes a placeholder into the content instead of its markup, which keeps the child mutable until
 * the element renders and preserves its position relative to content added through {@see HasContent::content()} and
 * {@see HasContent::html()}.
 *
 * @mixin HasContent
 */
trait HasSelectableChildren
{
    /**
     * Placeholder template written into the content for every appended child.
     */
    private const string CHILD_TOKEN = "\x1Aui-awesome-child-%d\x1A";
    /**
     * Appended children and the byte offsets immediately after their tokens.
     *
     * Content setters only append, so existing offsets remain valid across clones.
     *
     * @var list<array{element: Optgroup|Option, endOffset: non-negative-int}>
     */
    private array $children = [];

    /**
     * Appends children while preserving their position in the content.
     *
     * @param Optgroup|Option ...$children Child element instances.
     *
     * @return static New instance with the appended children.
     */
    private function appendChildren(Optgroup|Option ...$children): static
    {
        $new = clone $this;

        foreach ($children as $child) {
            $new->content .= $new->childToken(count($new->children));

            $new->children[] = [
                'element' => $child,
                'endOffset' => strlen($new->content),
            ];
        }

        return $new;
    }

    /**
     * Builds the placeholder for an appended child.
     *
     * @param int $index Position of the child in the appended list.
     *
     * @return string Placeholder written into the content.
     */
    private function childToken(int $index): string
    {
        return sprintf(self::CHILD_TOKEN, $index);
    }

    /**
     * Replaces every child placeholder with the rendered child.
     *
     * @param string[]|null $selectedValues Normalized selected values, or `null` to keep the child selection as
     * configured.
     *
     * @return string Content with the appended children rendered in place.
     */
    private function renderChildren(array|null $selectedValues): string
    {
        $replacements = [];

        foreach ($this->children as $index => $child) {
            $token = $this->childToken($index);

            $element = $child['element'];

            $rendered = $selectedValues === null
                ? $element->render()
                : $element->selectedValues($selectedValues)->render();

            $nextCharacter = $this->content[$child['endOffset']] ?? '';
            $separator = $nextCharacter === '' || $nextCharacter === "\n" ? '' : "\n";
            $replacements[$token] = $rendered . $separator;
        }

        return strtr($this->content, $replacements);
    }
}
