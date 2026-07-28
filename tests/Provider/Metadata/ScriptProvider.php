<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use Closure;
use PHPForge\Support\Stub\BackedString;
use UIAwesome\Html\Attribute\Values\{
    Attribute,
    Blocking,
    Crossorigin,
    ElementAttribute,
    Fetchpriority,
    Referrerpolicy,
};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Metadata\Script;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\ScriptTest} test cases.
 */
final class ScriptProvider
{
    /**
     * @return array<string, array{Blocking|string, string}>
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
     * @return array<string, array{Crossorigin|string, string}>
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
     * @return array<string, array{Fetchpriority|string, string}>
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
     * @return array<string, array{Referrerpolicy|string, string}>
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
     * @return array<string, array{BackedString|string, string}>
     */
    public static function type(): array
    {
        return [
            'module' => [
                'module',
                'module',
            ],
            'importmap' => [
                'importmap',
                'importmap',
            ],
            'speculationrules' => [
                'speculationrules',
                'speculationrules',
            ],
            'text/javascript' => [
                'text/javascript',
                'text/javascript',
            ],
            'application/ld+json' => [
                'application/ld+json',
                'application/ld+json',
            ],
            'application/json' => [
                'application/json',
                'application/json',
            ],
            'unrecognized value passes through' => [
                'not-a-mime-type',
                'not-a-mime-type',
            ],
            'enum' => [
                BackedString::VALUE,
                'value',
            ],
        ];
    }
}
