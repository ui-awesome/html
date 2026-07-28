<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Embedded;

use Closure;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, Loading, Referrerpolicy};
use UIAwesome\Html\Embedded\Iframe;
use UIAwesome\Html\Helper\Enum;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Embedded\IframeTest} test cases.
 */
final class IframeProvider
{
    /**
     * @return array<string, array{Closure(): Iframe, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'loading' => [
                static fn(): Iframe => Iframe::tag()->loading('invalid-value'),
                ElementAttribute::LOADING->value,
                implode("', '", Enum::normalizeStringArray(Loading::cases())),
            ],
            'referrerpolicy' => [
                static fn(): Iframe => Iframe::tag()->referrerpolicy('invalid-value'),
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
            ],
        ];
    }

    /**
     * @return array<string, array{string|Loading, string}>
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
}
