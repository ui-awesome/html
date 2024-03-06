<?php

declare(strict_types=1);

namespace UIAwesome\Html\Base;

use PHPForge\Widget\Block;
use UIAwesome\Html\{
    Attribute\HasClass,
    Attribute\HasData,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasStyle,
    Attribute\HasTitle,
    Builder,
    Concern\HasAttributes,
    Concern\HasContent,
};

/**
 * Provides a foundation for creating HTML block elements with various attributes and content.
 */
abstract class AbstractBlockElement extends Block
{
    use HasAttributes;
    use HasClass;
    use HasContent;
    use HasData;
    use HasId;
    use HasLang;
    use HasStyle;
    use HasTitle;

    protected string $tagName = '';

    /**
     * Begin rendering the block element.
     *
     * @return string The opening tag of the block element.
     */
    public function begin(): string
    {
        parent::begin();

        return Builder::beginTag($this->tagName, $this->attributes);
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        if ($this->isBeginExecuted() === false) {
            return Builder::createTag($this->tagName, $this->content, $this->attributes);
        }

        return Builder::endTag($this->tagName);
    }
}
