<?php

declare(strict_types=1);

namespace UIAwesome\Html\FormControl;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaControls,
    Attribute\Aria\HasAriaDescribedBy,
    Attribute\Aria\HasAriaDisabled,
    Attribute\Aria\HasAriaExpanded,
    Attribute\Aria\HasAriaLabel,
    Attribute\Aria\HasRole,
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
    Concern\HasAttributes,
    Concern\HasContainerCollection,
    Concern\HasContent,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTagName,
    Concern\HasTemplate,
    Helper\Validator,
    Interop\RenderInterface,
    Tag
};

/**
 * The `<button>` `HTML` element is an interactive element activated by a user with a mouse, keyboard, finger, voice
 * command, or other assistive technology. Once activated, it then performs an action, such as submitting a form or
 * opening a dialog.
 *
 * @link https://html.spec.whatwg.org/multipage/form-elements.html#the-button-element
 */
final class Button extends Element implements RenderInterface
{
    use HasAriaControls;
    use HasAriaDescribedBy;
    use HasAriaDisabled;
    use HasAriaExpanded;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasContent;
    use HasData;
    use HasFormaction;
    use HasFormenctype;
    use HasFormmethod;
    use HasFormnovalidate;
    use HasFormtarget;
    use HasId;
    use HasLang;
    use HasName;
    use HasPrefixCollection;
    use HasRole;
    use HasStyle;
    use HasSuffixCollection;
    use HasTabindex;
    use HasTagName;
    use HasTemplate;
    use HasTitle;

    protected string $type = 'button';

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'template()' => ['{prefix}\n{tag}\n{suffix}'],
            'tagName()' => ['button'],
        ];
    }

    /**
     * Generate the HTML representation of the element.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        $attributes = $this->attributes;

        Validator::inList(
            $this->tagName,
            'Invalid value "%s" for the tagname method. Allowed values are: "%s".',
            'a',
            'button'
        );

        $id = $this->getId();

        if ($this->ariaDescribedBy === true && $id !== '') {
            $attributes['aria-describedby'] = "$id-help";
        }

        if ($this->tagName === 'a' && $this->role === true) {
            $attributes['role'] = 'role';
        }

        $content = Tag::widget()
            ->attributes($attributes)
            ->content($this->content)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixTag($this->prefixTag)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixTag($this->suffixTag)
            ->tagName($this->tagName)
            ->template($this->template)
            ->type($this->type)
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
