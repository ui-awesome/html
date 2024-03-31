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
    Attribute\FormControl\HasFieldAttributes,
    Attribute\FormControl\HasForm,
    Attribute\HasClass,
    Attribute\HasData,
    Attribute\HasId,
    Attribute\HasLang,
    Attribute\HasName,
    Attribute\HasStyle,
    Attribute\HasTabindex,
    Attribute\HasTitle,
    Concern\HasAttributes,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTemplate,
    Core\Tag,
    Helper\Utils,
    Interop\AriaDescribedByInterface,
    Interop\InputInterface,
    Interop\RenderInterface,
};

/**
 * Provides a foundation for creating HTML `input` custom elements with various attributes and content.
 */
abstract class AbstractInput extends Element implements AriaDescribedByInterface, InputInterface, RenderInterface
{
    use CanBeAutofocus;
    use CanBeDisabled;
    use CanBeHidden;
    use CanBeReadonly;
    use HasAriaDescribedBy;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasData;
    use HasFieldAttributes;
    use HasForm;
    use HasId;
    use HasLang;
    use HasName;
    use HasPrefixCollection;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasTemplate;
    use HasTitle;

    protected string $type = 'text';

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        $shortClassName = Utils::getShortNameClass(static::class, false, true);

        return [
            'id()' => [Utils::generateId("$shortClassName-")],
            'template()' => ['{prefix}\n{tag}\n{suffix}'],
        ];
    }

    protected function renderInputTag(array $attributes, array $tokenValues = []): string
    {
        $id = $this->getId();

        if ($this->ariaDescribedBy === true && $id !== null) {
            $attributes['aria-describedby'] = "$id-help";
        }

        return Tag::widget()
            ->attributes($attributes)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixTag($this->prefixTag)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixTag($this->suffixTag)
            ->tagName('input')
            ->template($this->template)
            ->tokenValues($tokenValues)
            ->type($this->type)
            ->render();
    }
}
