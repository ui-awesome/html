<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Base;

use Stringable;
use UIAwesome\Html\Attribute\Form\{HasChecked, HasForm, HasRequired};
use UIAwesome\Html\Attribute\Global\{
    CanBeAutofocus,
    CanBeHidden,
    HasAccesskey,
    HasAria,
    HasClass,
    HasData,
    HasDir,
    HasEvents,
    HasId,
    HasLang,
    HasRole,
    HasStyle,
    HasTabindex,
    HasTitle,
    HasTranslate,
};
use UIAwesome\Html\Attribute\{HasDisabled, HasName, HasType, HasValue};
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, HasLabel};
use UIAwesome\Html\Helper\{Naming, Template};
use UIAwesome\Html\Interop\{BlockInterface, InlineInterface, VoidInterface};
use UIAwesome\Html\Mixin\{HasAttributes, HasPrefixCollection, HasSuffixCollection, HasTemplate};
use UIAwesome\Html\Phrasing\Label;

abstract class BaseInputChoice extends BaseTag
{
    use CanBeAutofocus;
    use CanBeEnclosedByLabel;
    use CanBeHidden;
    use HasAccesskey;
    use HasAria;
    use HasAttributes;
    use HasChecked;
    use HasClass;
    use HasData;
    use HasDir;
    use HasDisabled;
    use HasEvents;
    use HasForm;
    use HasId;
    use HasLabel;
    use HasLang;
    use HasName;
    use HasPrefixCollection;
    use HasRequired;
    use HasRole;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasTemplate;
    use HasTitle;
    use HasTranslate;
    use HasType;
    use HasValue;

    /**
     * Returns the tag instance representing the void element.
     *
     * Must be implemented by subclasses to specify the concrete void tag.
     *
     * Usage example:
     * ```php
     * public function getTag(): VoidInterface
     * {
     *     return Void::INPUT;
     * }
     * ```
     *
     * @return VoidInterface Tag instance for the void element.
     */
    abstract protected function getTag(): VoidInterface;

    /**
     * Returns the default configuration for the input element.
     *
     * Generates default values for the element based on the short class name.
     *
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
     */
    protected function loadDefault(): array
    {
        $shortClassName = Naming::getShortNameClass(static::class, false, true);

        return [
            'id' => [Naming::generateId("$shortClassName-")],
            'template' => ['{prefix}\n{tag}\n{label}\n{suffix}'],
        ];
    }

    /**
     * Renders the `<input>` element with its attributes.
     *
     * @return string Rendered HTML for the `<input>` element.
     */
    protected function run(): string
    {
        /** @var string|null $id */
        $id = $this->getAttribute('id', null);

        if ($this->notLabel || $this->label === '') {
            return $this->buildElement($id, '', ['{label}' => '']);
        }

        $labelTag = Label::tag();

        $labelAttributes = $this->labelAttributes;

        if (isset($labelAttributes['for']) === false) {
            $labelTag = $labelTag->for($id);
        }

        if ($this->enclosedByLabel === false) {
            $labelTag = $labelTag->attributes($this->labelAttributes)->content($this->label);

            return $this->buildElement($id, '', ['{label}' => $labelTag]);
        }

        $labelTag = $labelTag
            ->attributes($this->labelAttributes)
            ->html(
                PHP_EOL,
                Html::element($this->getTag(), '', $this->getAttributes()),
                PHP_EOL,
                $this->label,
                PHP_EOL,
            );

        return $this->buildElement($id, '', ['{tag}' => $labelTag, '{label}' => '']);
    }

    /**
     * Builds the input element using the provided content and token values.
     *
     * Constructs the element by rendering the prefix, main tag, and suffix using the configured template and
     * attributes.
     *
     * @param string|null $id Optional ID for the element, used for associating labels and ARIA attributes.
     * @param string|Stringable $content Content to be rendered inside the tag.
     * Note: The `<input>` element is a void element and does not render inner content. Use attributes such as `value`
     * to configure the input's value.
     * @param array $tokenValues Additional token values for template rendering.
     *
     * @return string Rendered HTML for the inline element.
     *
     * @phpstan-param mixed[] $tokenValues
     *
     * @phpstan-return string
     */
    private function buildElement(string|null $id, string|Stringable $content = '', array $tokenValues = []): string
    {
        $attributes = $this->getAttributes();
        $ariaDescribedBy = $this->getAttribute('aria-describedby', null);

        if ($ariaDescribedBy === true) {
            $attributes['aria-describedby'] = $id !== null ? "{$id}-help" : null;
        }

        $tokenTemplateValues = [
            '{prefix}' => $this->renderTag($this->prefixTag, $this->prefix, $this->prefixAttributes),
            '{tag}' => $this->renderTag($this->getTag(), (string) $content, $attributes),
            '{suffix}' => $this->renderTag($this->suffixTag, $this->suffix, $this->suffixAttributes),
        ];

        return Template::render($this->template, [...$tokenTemplateValues, ...$tokenValues]);
    }

    /**
     * Renders a tag or returns the content if the tag is not specified.
     *
     * @param BlockInterface|false|InlineInterface|VoidInterface $tag Tag instance or `false` to skip rendering.
     * @param string $content Content to be rendered inside the tag.
     * @param array $attributes HTML attributes for the tag.
     *
     * @return string Rendered tag or content.
     *
     * @phpstan-param mixed[] $attributes
     *
     * @phpstan-return string
     */
    private function renderTag(
        BlockInterface|false|InlineInterface|VoidInterface $tag,
        string $content,
        array $attributes = [],
    ): string {
        return $tag === false ? $content : Html::element($tag, $content, $attributes);
    }
}
