<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Embedded;

use Closure;
use UIAwesome\Html\Attribute\Values\{
    Attribute,
    Crossorigin,
    Decoding,
    ElementAttribute,
    Fetchpriority,
    Loading,
    Referrerpolicy,
};
use UIAwesome\Html\Embedded\Img;
use UIAwesome\Html\Helper\Enum;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Embedded\ImgTest} test cases.
 */
final class ImgProvider
{
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
     * @return array<string, array{Decoding|string, string}>
     */
    public static function decoding(): array
    {
        return [
            'async' => [
                'async',
                'async',
            ],
            'auto' => [
                'auto',
                'auto',
            ],
            'sync' => [
                'sync',
                'sync',
            ],
            'ASYNC' => [
                Decoding::ASYNC,
                'async',
            ],
            'AUTO' => [
                Decoding::AUTO,
                'auto',
            ],
            'SYNC' => [
                Decoding::SYNC,
                'sync',
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
     * @return array<string, array{Closure(): Img, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'crossorigin' => [
                static fn(): Img => Img::tag()->crossorigin('invalid-value'),
                Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeStringArray(Crossorigin::cases())),
            ],
            'decoding' => [
                static fn(): Img => Img::tag()->decoding('invalid-value'),
                ElementAttribute::DECODING->value,
                implode("', '", Enum::normalizeStringArray(Decoding::cases())),
            ],
            'fetchpriority' => [
                static fn(): Img => Img::tag()->fetchpriority('invalid-value'),
                Attribute::FETCHPRIORITY->value,
                implode("', '", Enum::normalizeStringArray(Fetchpriority::cases())),
            ],
            'loading' => [
                static fn(): Img => Img::tag()->loading('invalid-value'),
                ElementAttribute::LOADING->value,
                implode("', '", Enum::normalizeStringArray(Loading::cases())),
            ],
            'referrerpolicy' => [
                static fn(): Img => Img::tag()->referrerpolicy('invalid-value'),
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
            ],
        ];
    }

    /**
     * @return array<string, array{bool, string}>
     */
    public static function ismap(): array
    {
        return [
            'enabled' => [
                true,
                <<<HTML
                <img ismap>
                HTML,
            ],
            'disabled' => [
                false,
                <<<HTML
                <img>
                HTML,
            ],
        ];
    }

    /**
     * @return array<string, array{Loading|string, string}>
     */
    public static function loading(): array
    {
        return [
            'eager' => [
                'eager',
                'eager',
            ],
            'lazy' => [
                'lazy',
                'lazy',
            ],
            'EAGER' => [
                Loading::EAGER,
                'eager',
            ],
            'LAZY' => [
                Loading::LAZY,
                'lazy',
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
}
