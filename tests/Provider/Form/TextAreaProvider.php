<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Values\{Attribute, Autocapitalize, Autocorrect, GlobalAttribute};
use UIAwesome\Html\Form\TextArea;
use UIAwesome\Html\Form\Values\Wrap;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\TextAreaTest} test cases.
 */
final class TextAreaProvider
{
    /**
     * @return array<string, array{Autocapitalize|string, string}>
     */
    public static function autocapitalize(): array
    {
        return [
            'characters' => [
                'characters',
                'characters',
            ],
            'none' => [
                'none',
                'none',
            ],
            'off' => [
                'off',
                'off',
            ],
            'on' => [
                'on',
                'on',
            ],
            'sentences' => [
                'sentences',
                'sentences',
            ],
            'words' => [
                'words',
                'words',
            ],
            'CHARACTERS' => [
                Autocapitalize::CHARACTERS,
                'characters',
            ],
            'NONE' => [
                Autocapitalize::NONE,
                'none',
            ],
            'OFF' => [
                Autocapitalize::OFF,
                'off',
            ],
            'ON' => [
                Autocapitalize::ON,
                'on',
            ],
            'SENTENCES' => [
                Autocapitalize::SENTENCES,
                'sentences',
            ],
            'WORDS' => [
                Autocapitalize::WORDS,
                'words',
            ],
        ];
    }

    /**
     * @return array<string, array{Autocorrect|string, string}>
     */
    public static function autocorrect(): array
    {
        return [
            'off' => [
                'off',
                'off',
            ],
            'on' => [
                'on',
                'on',
            ],
            'OFF' => [
                Autocorrect::OFF,
                'off',
            ],
            'ON' => [
                Autocorrect::ON,
                'on',
            ],
        ];
    }

    /**
     * @return array<string, array{Closure(): TextArea, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'autocapitalize outside list' => [
                static fn(): TextArea => TextArea::tag()->autocapitalize('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    GlobalAttribute::AUTOCAPITALIZE->value,
                    implode("', '", Enum::normalizeStringArray(Autocapitalize::cases())),
                ),
            ],
            'autocorrect outside list' => [
                static fn(): TextArea => TextArea::tag()->autocorrect('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    GlobalAttribute::AUTOCORRECT->value,
                    implode("', '", Enum::normalizeStringArray(Autocorrect::cases())),
                ),
            ],
            'cols below range' => [
                static fn(): TextArea => TextArea::tag()->cols(0),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '0',
                    'cols',
                    'value > 0',
                ),
            ],
            'maxlength below range' => [
                static fn(): TextArea => TextArea::tag()->maxlength(-1),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-1',
                    Attribute::MAXLENGTH->value,
                    'value >= 0',
                ),
            ],
            'minlength below range' => [
                static fn(): TextArea => TextArea::tag()->minlength(-1),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-1',
                    Attribute::MINLENGTH->value,
                    'value >= 0',
                ),
            ],
            'rows below range' => [
                static fn(): TextArea => TextArea::tag()->rows(0),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '0',
                    'rows',
                    'value > 0',
                ),
            ],
            'wrap outside list' => [
                static fn(): TextArea => TextArea::tag()->wrap('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    'wrap',
                    implode("', '", Enum::normalizeStringArray(Wrap::cases())),
                ),
            ],
        ];
    }

    /**
     * @return array<string, array{string|Wrap, string}>
     */
    public static function wrap(): array
    {
        return [
            'hard' => [
                'hard',
                'hard',
            ],
            'off' => [
                'off',
                'off',
            ],
            'soft' => [
                'soft',
                'soft',
            ],
            'HARD' => [
                Wrap::HARD,
                'hard',
            ],
            'OFF' => [
                Wrap::OFF,
                'off',
            ],
            'SOFT' => [
                Wrap::SOFT,
                'soft',
            ],
        ];
    }
}
