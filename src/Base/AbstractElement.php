<?php

declare(strict_types=1);

namespace UIAwesome\Html\Base;

use PHPForge\Widget\Element;
use UIAwesome\{
    Html\Attribute\HasClass,
    Html\Attribute\HasData,
    Html\Attribute\HasId,
    Html\Attribute\HasLang,
    Html\Attribute\HasStyle,
    Html\Attribute\HasTitle,
    Html\Concern\HasAttributes,
    Html\Concern\HasPrefixCollection,
    Html\Concern\HasSuffixCollection,
    Html\Concern\HasTemplate,
    Html\Generator\Html,
    Html\Helper\Template,
    Html\Interop\RenderInterface
};

/**
 * Provides a foundation for creating HTML elements with various attributes and content.
 */
abstract class AbstractElement extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasData;
    use HasId;
    use HasLang;
    use HasPrefixCollection;
    use HasStyle;
    use HasSuffixCollection;
    use HasTemplate;
    use HasTitle;

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'template()' => ['{prefix}\n{tag}\n{suffix}'],
        ];
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @param string $tagName The tag name of the element.
     * @param string $content The content of the element.
     * @param array $tokenValues The token values to be used in the template.
     *
     * @return string The HTML representation of the element.
     */
    protected function buildElement(string $tagName, string $content = '', array $tokenValues = []): string
    {
        $tokenTemplateValues = [
            '{prefix}' => $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag),
            '{tag}' => Html::create($tagName, $content, $this->attributes),
            '{suffix}' => $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag),
        ];
        $tokenTemplateValues += $tokenValues;

        return Template::render($this->template, $tokenTemplateValues);
    }

    private function renderTag(array $attributes, string $content, false|string $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        return Html::create($tag, $content, $attributes);
    }
}
