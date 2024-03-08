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
    Attribute\FormControl\HasForm,
    Attribute\FormControl\HasFormaction,
    Attribute\FormControl\HasFormenctype,
    Attribute\FormControl\HasFormmethod,
    Attribute\FormControl\HasFormnovalidate,
    Attribute\FormControl\HasFormtarget,
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
    Concern\HasLabelCollection,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTemplate,
    FormControl\Label,
    Helper\Utils,
    Helper\Validator,
    Interop\RenderInterface,
    Tag
};

abstract class AbstractButton extends Element implements RenderInterface
{
    use CanBeAutofocus;
    use CanBeDisabled;
    use CanBeHidden;
    use CanBeReadonly;
    use HasAriaDescribedBy;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasData;
    use HasForm;
    use HasFormaction;
    use HasFormenctype;
    use HasFormmethod;
    use HasFormnovalidate;
    use HasFormtarget;
    use HasId;
    use HasLabelCollection;
    use HasLang;
    use HasName;
    use HasPrefixCollection;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasTemplate;
    use HasTitle;
    use HasValue;

    protected string $type = 'button';

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'containerTag()' => [],
            'id()' => [Utils::generateId('button-')],
            'template()' => ['{prefix}\n{label}\n{tag}\n{suffix}'],
        ];
    }

    protected function run(): string
    {
        Validator::isString($this->getValue());

        $id = $this->getId();

        $attributes = $this->attributes;
        $label = '';

        if ($this->ariaDescribedBy === true && $id !== null) {
            $attributes['aria-describedby'] = "$id-help";
        }

        if ($this->disableLabel === false) {
            $label = Label::widget()
                ->attributes($this->labelAttributes)
                ->content($this->label)
                ->for($this->labelFor ?? $id);
        }

        $content = Tag::widget()
            ->attributes($attributes)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixTag($this->prefixTag)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixTag($this->suffixTag)
            ->tagName('input')
            ->template($this->template)
            ->type($this->type)
            ->tokenValues(['{label}' => $label])
            ->render();

        return match ($this->containerTag) {
            false => $content,
            default => Tag::widget()
                ->attributes($this->containerAttributes)
                ->content($content)
                ->tagName($this->containerTag)
                ->render()
        };
    }
}
