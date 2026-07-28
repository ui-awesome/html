<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Values\{Attribute, GlobalAttribute, InputMode};
use UIAwesome\Html\Form\InputPassword;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputPasswordTest} test cases.
 */
final class InputPasswordProvider
{
    /**
     * @return array<string, array{Closure(): InputPassword, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'inputmode outside list' => [
                static fn(): InputPassword => InputPassword::tag()->inputMode('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    GlobalAttribute::INPUTMODE->value,
                    implode("', '", Enum::normalizeStringArray(InputMode::cases())),
                ),
            ],
            'maxlength below range' => [
                static fn(): InputPassword => InputPassword::tag()->maxlength(-1),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-1',
                    Attribute::MAXLENGTH->value,
                    'value >= 0',
                ),
            ],
            'minlength below range' => [
                static fn(): InputPassword => InputPassword::tag()->minlength(-1),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-1',
                    Attribute::MINLENGTH->value,
                    'value >= 0',
                ),
            ],
            'tabindex below range' => [
                static fn(): InputPassword => InputPassword::tag()->tabIndex(-2),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-2',
                    GlobalAttribute::TABINDEX->value,
                    'value >= -1',
                ),
            ],
        ];
    }
}
