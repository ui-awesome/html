<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Palpable;

use Closure;
use PHPForge\Support\Stub\BackedString;
use UIAwesome\Html\Attribute\Values\{Attribute, Referrerpolicy, Rel, Target};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Palpable\A;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Palpable\ATest} test cases.
 */
final class AProvider
{
    /**
     * @return array<string, array{Closure(): A, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'referrerpolicy' => [
                static fn(): A => A::tag()->referrerpolicy('invalid-value'),
                Attribute::REFERRERPOLICY->value,
                implode("', '", Enum::normalizeStringArray(Referrerpolicy::cases())),
            ],
            'rel' => [
                static fn(): A => A::tag()->rel('invalid-value'),
                Attribute::REL->value,
                implode("', '", Enum::normalizeStringArray(Rel::cases())),
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
     * @return array<string, array{Rel|string, string}>
     */
    public static function rel(): array
    {
        return [
            'alternate' => [
                'alternate',
                'alternate',
            ],
            'apple-touch-icon' => [
                'apple-touch-icon',
                'apple-touch-icon',
            ],
            'apple-touch-startup-image' => [
                'apple-touch-startup-image',
                'apple-touch-startup-image',
            ],
            'author' => [
                'author',
                'author',
            ],
            'bookmark' => [
                'bookmark',
                'bookmark',
            ],
            'canonical' => [
                'canonical',
                'canonical',
            ],
            'compression-dictionary' => [
                'compression-dictionary',
                'compression-dictionary',
            ],
            'dns-prefetch' => [
                'dns-prefetch',
                'dns-prefetch',
            ],
            'expect' => [
                'expect',
                'expect',
            ],
            'external' => [
                'external',
                'external',
            ],
            'help' => [
                'help',
                'help',
            ],
            'icon' => [
                'icon',
                'icon',
            ],
            'license' => [
                'license',
                'license',
            ],
            'manifest' => [
                'manifest',
                'manifest',
            ],
            'me' => [
                'me',
                'me',
            ],
            'modulepreload' => [
                'modulepreload',
                'modulepreload',
            ],
            'next' => [
                'next',
                'next',
            ],
            'nofollow' => [
                'nofollow',
                'nofollow',
            ],
            'noopener' => [
                'noopener',
                'noopener',
            ],
            'noreferrer' => [
                'noreferrer',
                'noreferrer',
            ],
            'opener' => [
                'opener',
                'opener',
            ],
            'pingback' => [
                'pingback',
                'pingback',
            ],
            'preconnect' => [
                'preconnect',
                'preconnect',
            ],
            'prefetch' => [
                'prefetch',
                'prefetch',
            ],
            'preload' => [
                'preload',
                'preload',
            ],
            'prerender' => [
                'prerender',
                'prerender',
            ],
            'prev' => [
                'prev',
                'prev',
            ],
            'privacy-policy' => [
                'privacy-policy',
                'privacy-policy',
            ],
            'search' => [
                'search',
                'search',
            ],
            'shortcut' => [
                'shortcut',
                'shortcut',
            ],
            'stylesheet' => [
                'stylesheet',
                'stylesheet',
            ],
            'tag' => [
                'tag',
                'tag',
            ],
            'terms-of-service' => [
                'terms-of-service',
                'terms-of-service',
            ],
            'ALTERNATE' => [
                Rel::ALTERNATE,
                'alternate',
            ],
            'APPLE_TOUCH_ICON' => [
                Rel::APPLE_TOUCH_ICON,
                'apple-touch-icon',
            ],
            'APPLE_TOUCH_STARTUP_IMAGE' => [
                Rel::APPLE_TOUCH_STARTUP_IMAGE,
                'apple-touch-startup-image',
            ],
            'AUTHOR' => [
                Rel::AUTHOR,
                'author',
            ],
            'BOOKMARK' => [
                Rel::BOOKMARK,
                'bookmark',
            ],
            'CANONICAL' => [
                Rel::CANONICAL,
                'canonical',
            ],
            'COMPRESSION_DICTIONARY' => [
                Rel::COMPRESSION_DICTIONARY,
                'compression-dictionary',
            ],
            'DNS_PREFETCH' => [
                Rel::DNS_PREFETCH,
                'dns-prefetch',
            ],
            'EXPECT' => [
                Rel::EXPECT,
                'expect',
            ],
            'EXTERNAL' => [
                Rel::EXTERNAL,
                'external',
            ],
            'HELP' => [
                Rel::HELP,
                'help',
            ],
            'ICON' => [
                Rel::ICON,
                'icon',
            ],
            'LICENSE' => [
                Rel::LICENSE,
                'license',
            ],
            'MANIFEST' => [
                Rel::MANIFEST,
                'manifest',
            ],
            'ME' => [
                Rel::ME,
                'me',
            ],
            'MODULEPRELOAD' => [
                Rel::MODULEPRELOAD,
                'modulepreload',
            ],
            'NEXT' => [
                Rel::NEXT,
                'next',
            ],
            'NOFOLLOW' => [
                Rel::NOFOLLOW,
                'nofollow',
            ],
            'NOOPENER' => [
                Rel::NOOPENER,
                'noopener',
            ],
            'NOREFERRER' => [
                Rel::NOREFERRER,
                'noreferrer',
            ],
            'OPENER' => [
                Rel::OPENER,
                'opener',
            ],
            'PINGBACK' => [
                Rel::PINGBACK,
                'pingback',
            ],
            'PRECONNECT' => [
                Rel::PRECONNECT,
                'preconnect',
            ],
            'PREFETCH' => [
                Rel::PREFETCH,
                'prefetch',
            ],
            'PRELOAD' => [
                Rel::PRELOAD,
                'preload',
            ],
            'PRERENDER' => [
                Rel::PRERENDER,
                'prerender',
            ],
            'PREV' => [
                Rel::PREV,
                'prev',
            ],
            'PRIVACY_POLICY' => [
                Rel::PRIVACY_POLICY,
                'privacy-policy',
            ],
            'SEARCH' => [
                Rel::SEARCH,
                'search',
            ],
            'SHORTCUT' => [
                Rel::SHORTCUT,
                'shortcut',
            ],
            'STYLESHEET' => [
                Rel::STYLESHEET,
                'stylesheet',
            ],
            'TAG' => [
                Rel::TAG,
                'tag',
            ],
            'TERMS_OF_SERVICE' => [
                Rel::TERMS_OF_SERVICE,
                'terms-of-service',
            ],
        ];
    }

    /**
     * @return array<string, array{string|Target, string}>
     */
    public static function target(): array
    {
        return [
            '_blank' => [
                '_blank',
                '_blank',
            ],
            '_parent' => [
                '_parent',
                '_parent',
            ],
            '_self' => [
                '_self',
                '_self',
            ],
            '_top' => [
                '_top',
                '_top',
            ],
            'BLANK' => [
                Target::BLANK,
                '_blank',
            ],
            'PARENT' => [
                Target::PARENT,
                '_parent',
            ],
            'SELF' => [
                Target::SELF,
                '_self',
            ],
            'TOP' => [
                Target::TOP,
                '_top',
            ],
        ];
    }

    /**
     * @return array<string, array{BackedString|string, string}>
     */
    public static function type(): array
    {
        return [
            'text/html' => [
                'text/html',
                'text/html',
            ],
            'application/pdf' => [
                'application/pdf',
                'application/pdf',
            ],
            'application/zip' => [
                'application/zip',
                'application/zip',
            ],
            'image/png' => [
                'image/png',
                'image/png',
            ],
            'text/plain' => [
                'text/plain',
                'text/plain',
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
