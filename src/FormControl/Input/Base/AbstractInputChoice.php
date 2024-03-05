<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Base;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaDescribedBy,
    Attribute\Aria\HasAriaLabel,
    Attribute\CanBeAutofocus,
    Attribute\CanBeHidden,
    Attribute\FormControl\CanBeDisabled,
    Attribute\FormControl\CanBeReadonly,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasFieldAttributes,
    Attribute\FormControl\HasForm,
    Attribute\FormControl\Input\CanBeChecked,
    Attribute\HasClass,
    Attribute\HasData,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasName,
    Attribute\HasStyle,
    Attribute\HasTabindex,
    Attribute\HasTitle,
    Attribute\HasValue,
    Concern\HasAttributes,
    Concern\HasContainerCollection,
    Concern\HasContent,
    Concern\HasLabelCollection,
    Concern\HasPrefixCollection,
    Concern\HasSeparator,
    Concern\HasSuffixCollection,
    Concern\HasTemplate,
    Concern\HasUncheckedCollection,
    FormControl\Input\Hidden,
    FormControl\Label,
    Helper\Template,
    Helper\Utils,
    Helper\Validator,
    Interop\AriaDescribedByInterface,
    Interop\CheckedInterface,
    Interop\InputInterface,
    Interop\LabelInterface,
    Interop\RenderInterface,
    Interop\Validator\RequiredInterface,
    Tag
};

/**
 * Provides a foundation for creating HTML elements with various attributes and content.
 */
abstract class AbstractInputChoice extends Element implements
    AriaDescribedByInterface,
    CheckedInterface,
    InputInterface,
    LabelInterface,
    RenderInterface,
    RequiredInterface
{
    use CanBeAutofocus;
    use CanBeChecked;
    use CanBeDisabled;
    use CanBeHidden;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAriaDescribedBy;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasContent;
    use HasData;
    use HasFieldAttributes;
    use HasForm;
    use HasId;
    use HasLabelCollection;
    use HasLang;
    use HasName;
    use HasPrefixCollection;
    use HasSeparator;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasTemplate;
    use HasTitle;
    use HasUncheckedCollection;
    use HasValue;

    protected bool $enclosedByLabel = false;
    protected string $tagName = '';

    /**
     * Set the current instance as being enclosed by a label.
     *
     * @param bool $value The value to set.
     *
     * @return static A new instance of of the current class with the specified enclosed by label property.
     */
    public function enclosedByLabel(bool $value): static
    {
        $new = clone $this;
        $new->enclosedByLabel = $value;

        return $new;
    }

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        $class = Utils::getShortNameClass(static::class, false, true);

        return [
            'id()' => [Utils::generateId("$class-")],
            'separator()' => [PHP_EOL],
            'template()' => ['{prefix}\n{unchecktag}\n{tag}\n{label}\n{suffix}'],
        ];
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function buildChoiceTag(string $type): string
    {
        $value = $this->getValue();

        Validator::isScalar($value, $this->checked);

        $attributes = $this->attributes;

        $id = $this->getId();

        if ($this->ariaDescribedBy === true && $id !== null) {
            $attributes['aria-describedby'] = "$id-help";
        }

        $value = is_bool($value) ? (int) $value : $value;

        if ($this->checked === true && $value === null) {
            $attributes['checked'] = true;
        }

        if (is_scalar($this->checked) && $value !== null) {
            $attributes['checked'] = "$value" === "$this->checked";
        }

        unset($attributes['type'], $attributes['value']);

        $tag = Tag::widget()->attributes($attributes)->tagName('input')->type($type)->value($value)->render();
        $labelTag = '';

        if ($this->enclosedByLabel === true && $this->disableLabel === false && $this->label !== '') {
            $tag = $this->renderLabel(
                $this->separator,
                $tag,
                $this->separator,
                $this->label,
                $this->separator,
            );
        } elseif ($this->disableLabel === false) {
            $labelTag = $this->renderLabel($this->label);
        }

        $content = $this->prepareTemplate($tag, $labelTag);

        return match ($this->containerTag) {
            false => $content,
            default => Tag::widget()
                ->attributes($this->containerAttributes)
                ->content($content)
                ->tagName($this->containerTag)
                ->render()
        };
    }

    private function prepareTemplate(string $tag, string $labelTag): string
    {
        $tokenValues = [
            '{prefix}' => $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag),
            '{unchecktag}' => $this->renderUncheckTag(),
            '{tag}' => $tag,
            '{label}' => $labelTag,
            '{suffix}' => $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag),
        ];

        return Template::render($this->template, $tokenValues);
    }

    private function renderLabel(string ...$content): string
    {
        return Label::widget()
            ->attributes($this->labelAttributes)
            ->content(...$content)
            ->for($this->labelFor ?? $this->getId())
            ->render();
    }

    private function renderTag(array $attributes, string $content, false|string $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        return Tag::widget()->attributes($attributes)->content($content)->tagName($tag)->render();
    }

    private function renderUncheckTag(): string
    {
        if ($this->uncheckValue === null) {
            return '';
        }

        return Hidden::widget()
            ->attributes($this->uncheckAttributes)
            ->id(null)
            ->name($this->getName())
            ->value($this->uncheckValue)
            ->render();
    }
}
