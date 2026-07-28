<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message as AttributeMessage;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, GlobalAttribute, PopoverTargetAction};
use UIAwesome\Html\Form\Button;
use UIAwesome\Html\Form\Values\ButtonType;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\ButtonTest} test cases.
 */
final class ButtonProvider
{
    /**
     * @return array<string, array{Closure(): Button, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'popovertargetaction outside list' => [
                static fn(): Button => Button::tag()->popoverTargetAction('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    ElementAttribute::POPOVERTARGETACTION->value,
                    implode("', '", Enum::normalizeStringArray(PopoverTargetAction::cases())),
                ),
            ],
            'tabindex below range' => [
                static fn(): Button => Button::tag()->tabIndex(-2),
                AttributeMessage::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-2',
                    GlobalAttribute::TABINDEX->value,
                    'value >= -1',
                ),
            ],
            'type outside list' => [
                static fn(): Button => Button::tag()->type('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    Attribute::TYPE->value,
                    implode("', '", Enum::normalizeStringArray(ButtonType::cases())),
                ),
            ],
        ];
    }

    /**
     * @return array<string, array{string|PopoverTargetAction, string}>
     */
    public static function popoverTargetAction(): array
    {
        return [
            'hide' => [
                'hide',
                'hide',
            ],
            'show' => [
                'show',
                'show',
            ],
            'toggle' => [
                'toggle',
                'toggle',
            ],
            'HIDE' => [
                PopoverTargetAction::HIDE,
                'hide',
            ],
            'SHOW' => [
                PopoverTargetAction::SHOW,
                'show',
            ],
            'TOGGLE' => [
                PopoverTargetAction::TOGGLE,
                'toggle',
            ],
        ];
    }

    /**
     * @return array<string, array{string|ButtonType, string}>
     */
    public static function type(): array
    {
        return [
            'button' => [
                'button',
                'button',
            ],
            'reset' => [
                'reset',
                'reset',
            ],
            'submit' => [
                'submit',
                'submit',
            ],
            'BUTTON' => [
                ButtonType::BUTTON,
                'button',
            ],
            'RESET' => [
                ButtonType::RESET,
                'reset',
            ],
            'SUBMIT' => [
                ButtonType::SUBMIT,
                'submit',
            ],
        ];
    }
}
