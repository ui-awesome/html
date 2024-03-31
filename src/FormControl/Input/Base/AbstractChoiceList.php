<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl\Input\Base;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaDescribedBy,
    Attribute\Aria\HasAriaLabel,
    Attribute\CanBeAutofocus,
    Attribute\FormControl\CanBeRequired,
    Attribute\FormControl\HasFieldAttributes,
    Attribute\FormControl\Input\CanBeChecked,
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasName,
    Attribute\HasTabindex,
    Concern\HasAttributes,
    Concern\HasContainerCollection,
    Concern\HasLabelCollection,
    Concern\HasSeparator,
    Concern\HasTemplate,
    Concern\HasUncheckedCollection,
    Core\Tag,
    FormControl\Input\Hidden,
    FormControl\Label,
    Helper\Template,
    Helper\Utils,
    Interop\AriaDescribedByInterface,
    Interop\CheckedInterface,
    Interop\InputInterface,
    Interop\LabelInterface,
    Interop\RenderInterface,
    Interop\Validator\RequiredInterface
};

use function in_array;
use function is_bool;
use function is_int;
use function is_scalar;

abstract class AbstractChoiceList extends Element implements
    AriaDescribedByInterface,
    CheckedInterface,
    InputInterface,
    LabelInterface,
    RenderInterface,
    RequiredInterface
{
    use CanBeAutofocus;
    use CanBeChecked;
    use CanBeRequired;
    use HasAriaDescribedBy;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasFieldAttributes;
    use HasId;
    use HasLabelCollection;
    use HasName;
    use HasSeparator;
    use HasTabindex;
    use HasTemplate;
    use HasUncheckedCollection;

    protected array $attributes = [];
    protected bool $enclosedByLabel = false;
    protected string $labelItemClass = '';
    protected bool $labelItemOverride = false;

    /**
     * @psalm-var \UIAwesome\Html\FormControl\Input\Checkbox[]|\UIAwesome\Html\FormControl\Input\Radio[] $items
     */
    protected array $items = [];

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
     * Set a new label item class that will be used for the label item.
     *
     * @param string $value The label item class to be used for the label item.
     * @param bool $override Whether to override the current label item class.
     *
     * @return static A new instance of the current class with the specified label item class.
     */
    public function labelItemClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->labelItemClass = $value;
        $new->labelItemOverride = $override;

        return $new;
    }

    /**
     * Generate the HTML representation of CheckboxList or RadioList.
     *
     * @param string $type The type of the list.
     *
     * @return string The HTML representation of the element.
     */
    protected function buildChoiceListTag(string $type): string
    {
        $attributes = $this->attributes;
        $containerAttributes = $this->containerAttributes;
        $listItems = [];
        /** @var string $name */
        $name = $attributes['name'] ?? '';
        $id = $this->getId();

        if ($this->ariaDescribedBy === true) {
            $attributes['aria-describedby'] = "$id-help";
        }

        if (array_key_exists('autofocus', $attributes) && is_bool($attributes['autofocus'])) {
            $containerAttributes['autofocus'] = $attributes['autofocus'];
        }

        if (array_key_exists('tabindex', $attributes) && is_int($attributes['tabindex'])) {
            $containerAttributes['tabindex'] = $attributes['tabindex'];
        }

        if ($name !== '' && $type === 'checkbox') {
            $name = Utils::generateArrayableName($name);
        }

        unset($attributes['autofocus'], $attributes['tabindex'], $attributes['value']);

        foreach ($this->items as $key => $item) {
            $itemValue = $item->getValue();

            if (is_scalar($this->checked) && $itemValue !== null) {
                $attributes['checked'] = (string) $itemValue === (string) $this->checked;
            }

            if (is_array($this->checked) && $itemValue !== null) {
                $attributes['checked'] = in_array($itemValue, $this->checked);
            }

            $listItemId = $id === null ? null : "$id-w$key";

            $listItem = $item
                ->attributes($attributes)
                ->enclosedByLabel($this->enclosedByLabel)
                ->id($listItemId)
                ->labelClass($this->labelItemClass, $this->labelItemOverride)
                ->name($name)
                ->separator($this->separator);

            if ($this->enclosedByLabel === true) {
                $listItem = $listItem->enclosedByLabel(true);
            }

            $listItems[] = $listItem;
        }

        $choiceTag = implode(PHP_EOL, $listItems);
        $uncheckTag = match ($this->uncheckValue) {
            null => '',
            default => Hidden::widget()->id(null)->name($name)->value($this->uncheckValue)->render(),
        };

        if ($uncheckTag !== '') {
            $uncheckTag .= PHP_EOL;
        }

        $tag = match ($this->containerTag) {
            false => $choiceTag,
            default => Tag::widget()
                ->attributes($containerAttributes)
                ->content($uncheckTag, $choiceTag)
                ->tagName($this->containerTag)
                ->render(),
        };

        return Template::render(
            $this->template,
            [
                '{label}' => $this->renderLabelTag(),
                '{tag}' => $tag,
            ],
        );
    }

    private function renderLabelTag(): string
    {
        return match ($this->disableLabel) {
            true => '',
            default => Label::widget()->attributes($this->labelAttributes)->content($this->label)->render(),
        };
    }
}
