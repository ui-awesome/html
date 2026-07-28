<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use Closure;
use UIAwesome\Html\Attribute\Values\{
    Attribute,
    Blocking,
    Crossorigin,
    ElementAttribute,
    Fetchpriority,
    Referrerpolicy,
    Type,
};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Metadata\Script;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\ScriptTest} test cases.
 */
final class ScriptProvider
{
    /**
     * @return array<string, array{string|Blocking, string}>
     */
    public static function blocking(): array
    {
        return [
            'render' => [
                'render',
                'render',
            ],
            'RENDER' => [
                Blocking::RENDER,
                'render',
            ],
        ];
    }

    /**
     * @return array<string, array{string|Crossorigin, string}>
     */
    public static function crossorigin(): array
    {
        return [
            'anonymous' => [
                'anonymous',
                'anonymous',
            ],
            'use-credentials' => [
                'use-credentials',
                'use-credentials',
            ],
            'ANONYMOUS' => [
                Crossorigin::ANONYMOUS,
                'anonymous',
            ],
            'USE_CREDENTIALS' => [
                Crossorigin::USE_CREDENTIALS,
                'use-credentials',
            ],
        ];
    }

    /**
     * @return array<string, array{string|Fetchpriority, string}>
     */
    public static function fetchpriority(): array
    {
        return [
            'auto' => [
                'auto',
                'auto',
            ],
            'high' => [
                'high',
                'high',
            ],
            'low' => [
                'low',
                'low',
            ],
            'AUTO' => [
                Fetchpriority::AUTO,
                'auto',
            ],
            'HIGH' => [
                Fetchpriority::HIGH,
                'high',
            ],
            'LOW' => [
                Fetchpriority::LOW,
                'low',
            ],
        ];
    }

    /**
     * @return array<string, array{Closure(): Script, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'blocking' => [
                static fn(): Script => Script::tag()->blocking('invalid-value'),
                ElementAttribute::BLOCKING->value,
                implode("', '", Enum::normalizeStringArray(Blocking::cases())),
            ],
            'crossorigin' => [
                static fn(): Script => Script::tag()->crossorigin('invalid-value'),
                Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeStringArray(Crossorigin::cases())),
            ],
            'fetchpriority' => [
                static fn(): Script => Script::tag()->fetchpriority('invalid-value'),
                Attribute::FETCHPRIORITY->value,
                implode("', '", Enum::normalizeStringArray(Fetchpriority::cases())),
            ],
            'referrerpolicy' => [
                static fn(): Script => Script::tag()->referrerpolicy('invalid-value'),
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
            ],
        ];
    }

    /**
     * @return array<string, array{string|Referrerpolicy, string}>
     */
    public static function referrerpolicy(): array
    {
        return [
            'no-referrer' => [
                'no-referrer',
                'no-referrer',
            ],
            'no-referrer-when-downgrade' => [
                'no-referrer-when-downgrade',
                'no-referrer-when-downgrade',
            ],
            'origin' => [
                'origin',
                'origin',
            ],
            'origin-when-cross-origin' => [
                'origin-when-cross-origin',
                'origin-when-cross-origin',
            ],
            'same-origin' => [
                'same-origin',
                'same-origin',
            ],
            'strict-origin' => [
                'strict-origin',
                'strict-origin',
            ],
            'strict-origin-when-cross-origin' => [
                'strict-origin-when-cross-origin',
                'strict-origin-when-cross-origin',
            ],
            'unsafe-url' => [
                'unsafe-url',
                'unsafe-url',
            ],
            'NO_REFERRER' => [
                Referrerpolicy::NO_REFERRER,
                'no-referrer',
            ],
            'NO_REFERRER_WHEN_DOWNGRADE' => [
                Referrerpolicy::NO_REFERRER_WHEN_DOWNGRADE,
                'no-referrer-when-downgrade',
            ],
            'ORIGIN' => [
                Referrerpolicy::ORIGIN,
                'origin',
            ],
            'ORIGIN_WHEN_CROSS_ORIGIN' => [
                Referrerpolicy::ORIGIN_WHEN_CROSS_ORIGIN,
                'origin-when-cross-origin',
            ],
            'SAME_ORIGIN' => [
                Referrerpolicy::SAME_ORIGIN,
                'same-origin',
            ],
            'STRICT_ORIGIN' => [
                Referrerpolicy::STRICT_ORIGIN,
                'strict-origin',
            ],
            'STRICT_ORIGIN_WHEN_CROSS_ORIGIN' => [
                Referrerpolicy::STRICT_ORIGIN_WHEN_CROSS_ORIGIN,
                'strict-origin-when-cross-origin',
            ],
            'UNSAFE_URL' => [
                Referrerpolicy::UNSAFE_URL,
                'unsafe-url',
            ],
        ];
    }

    /**
     * @return array<array-key, array{string|Type, string}>
     */
    public static function type(): array
    {
        return [
            'button' => [
                'button',
                'button',
            ],
            'checkbox' => [
                'checkbox',
                'checkbox',
            ],
            'color' => [
                'color',
                'color',
            ],
            'date' => [
                'date',
                'date',
            ],
            'datetime-local' => [
                'datetime-local',
                'datetime-local',
            ],
            '1' => [
                '1',
                '1',
            ],
            'email' => [
                'email',
                'email',
            ],
            'file' => [
                'file',
                'file',
            ],
            'hidden' => [
                'hidden',
                'hidden',
            ],
            'image' => [
                'image',
                'image',
            ],
            'importmap' => [
                'importmap',
                'importmap',
            ],
            'a' => [
                'a',
                'a',
            ],
            'i' => [
                'i',
                'i',
            ],
            'module' => [
                'module',
                'module',
            ],
            'month' => [
                'month',
                'month',
            ],
            'number' => [
                'number',
                'number',
            ],
            'password' => [
                'password',
                'password',
            ],
            'radio' => [
                'radio',
                'radio',
            ],
            'range' => [
                'range',
                'range',
            ],
            'reset' => [
                'reset',
                'reset',
            ],
            'search' => [
                'search',
                'search',
            ],
            'speculationrules' => [
                'speculationrules',
                'speculationrules',
            ],
            'submit' => [
                'submit',
                'submit',
            ],
            'tel' => [
                'tel',
                'tel',
            ],
            'text' => [
                'text',
                'text',
            ],
            'text/css' => [
                'text/css',
                'text/css',
            ],
            'text/html' => [
                'text/html',
                'text/html',
            ],
            'text/javascript' => [
                'text/javascript',
                'text/javascript',
            ],
            'time' => [
                'time',
                'time',
            ],
            'A' => [
                'A',
                'A',
            ],
            'I' => [
                'I',
                'I',
            ],
            'url' => [
                'url',
                'url',
            ],
            'week' => [
                'week',
                'week',
            ],
            'BUTTON' => [
                Type::BUTTON,
                'button',
            ],
            'CHECKBOX' => [
                Type::CHECKBOX,
                'checkbox',
            ],
            'COLOR' => [
                Type::COLOR,
                'color',
            ],
            'DATE' => [
                Type::DATE,
                'date',
            ],
            'DATETIME_LOCAL' => [
                Type::DATETIME_LOCAL,
                'datetime-local',
            ],
            'DECIMAL' => [
                Type::DECIMAL,
                '1',
            ],
            'EMAIL' => [
                Type::EMAIL,
                'email',
            ],
            'FILE' => [
                Type::FILE,
                'file',
            ],
            'HIDDEN' => [
                Type::HIDDEN,
                'hidden',
            ],
            'IMAGE' => [
                Type::IMAGE,
                'image',
            ],
            'IMPORTMAP' => [
                Type::IMPORTMAP,
                'importmap',
            ],
            'LOWER_ALPHA' => [
                Type::LOWER_ALPHA,
                'a',
            ],
            'LOWER_ROMAN' => [
                Type::LOWER_ROMAN,
                'i',
            ],
            'MODULE' => [
                Type::MODULE,
                'module',
            ],
            'MONTH' => [
                Type::MONTH,
                'month',
            ],
            'NUMBER' => [
                Type::NUMBER,
                'number',
            ],
            'PASSWORD' => [
                Type::PASSWORD,
                'password',
            ],
            'RADIO' => [
                Type::RADIO,
                'radio',
            ],
            'RANGE' => [
                Type::RANGE,
                'range',
            ],
            'RESET' => [
                Type::RESET,
                'reset',
            ],
            'SEARCH' => [
                Type::SEARCH,
                'search',
            ],
            'SPECULATIONRULES' => [
                Type::SPECULATIONRULES,
                'speculationrules',
            ],
            'SUBMIT' => [
                Type::SUBMIT,
                'submit',
            ],
            'TEL' => [
                Type::TEL,
                'tel',
            ],
            'TEXT' => [
                Type::TEXT,
                'text',
            ],
            'TEXT_CSS' => [
                Type::TEXT_CSS,
                'text/css',
            ],
            'TEXT_HTML' => [
                Type::TEXT_HTML,
                'text/html',
            ],
            'TEXT_JAVASCRIPT' => [
                Type::TEXT_JAVASCRIPT,
                'text/javascript',
            ],
            'TIME' => [
                Type::TIME,
                'time',
            ],
            'UPPER_ALPHA' => [
                Type::UPPER_ALPHA,
                'A',
            ],
            'UPPER_ROMAN' => [
                Type::UPPER_ROMAN,
                'I',
            ],
            'URL' => [
                Type::URL,
                'url',
            ],
            'WEEK' => [
                Type::WEEK,
                'week',
            ],
        ];
    }
}
