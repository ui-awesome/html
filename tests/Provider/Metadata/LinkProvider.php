<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use Closure;
use PHPForge\Support\Stub\BackedString;
use UIAwesome\Html\Attribute\Values\{
    AsValue,
    Attribute,
    Blocking,
    Crossorigin,
    ElementAttribute,
    Fetchpriority,
    Referrerpolicy,
    Rel,
};
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Metadata\Link;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\LinkTest} test cases.
 */
final class LinkProvider
{
    /**
     * @return array<string, array{AsValue|string, string}>
     */
    public static function as(): array
    {
        return [
            'audio' => [
                'audio',
                'audio',
            ],
            'document' => [
                'document',
                'document',
            ],
            'embed' => [
                'embed',
                'embed',
            ],
            'fetch' => [
                'fetch',
                'fetch',
            ],
            'font' => [
                'font',
                'font',
            ],
            'image' => [
                'image',
                'image',
            ],
            'object' => [
                'object',
                'object',
            ],
            'script' => [
                'script',
                'script',
            ],
            'style' => [
                'style',
                'style',
            ],
            'track' => [
                'track',
                'track',
            ],
            'video' => [
                'video',
                'video',
            ],
            'worker' => [
                'worker',
                'worker',
            ],
            'AUDIO' => [
                AsValue::AUDIO,
                'audio',
            ],
            'DOCUMENT' => [
                AsValue::DOCUMENT,
                'document',
            ],
            'EMBED' => [
                AsValue::EMBED,
                'embed',
            ],
            'FETCH' => [
                AsValue::FETCH,
                'fetch',
            ],
            'FONT' => [
                AsValue::FONT,
                'font',
            ],
            'IMAGE' => [
                AsValue::IMAGE,
                'image',
            ],
            'OBJECT' => [
                AsValue::OBJECT,
                'object',
            ],
            'SCRIPT' => [
                AsValue::SCRIPT,
                'script',
            ],
            'STYLE' => [
                AsValue::STYLE,
                'style',
            ],
            'TRACK' => [
                AsValue::TRACK,
                'track',
            ],
            'VIDEO' => [
                AsValue::VIDEO,
                'video',
            ],
            'WORKER' => [
                AsValue::WORKER,
                'worker',
            ],
        ];
    }

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
     * @return array<string, array{Closure(): Link, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'blocking' => [
                static fn(): Link => Link::tag()->blocking('invalid-value'),
                ElementAttribute::BLOCKING->value,
                implode("', '", Enum::normalizeStringArray(Blocking::cases())),
            ],
            'crossorigin' => [
                static fn(): Link => Link::tag()->crossorigin('invalid-value'),
                Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeStringArray(Crossorigin::cases())),
            ],
            'fetchpriority' => [
                static fn(): Link => Link::tag()->fetchpriority('invalid-value'),
                Attribute::FETCHPRIORITY->value,
                implode("', '", Enum::normalizeStringArray(Fetchpriority::cases())),
            ],
            'referrerpolicy' => [
                static fn(): Link => Link::tag()->referrerpolicy('invalid-value'),
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
     * @return array<string, array{BackedString|string, string}>
     */
    public static function type(): array
    {
        return [
            'text/css' => [
                'text/css',
                'text/css',
            ],
            'application/rss+xml' => [
                'application/rss+xml',
                'application/rss+xml',
            ],
            'application/atom+xml' => [
                'application/atom+xml',
                'application/atom+xml',
            ],
            'application/manifest+json' => [
                'application/manifest+json',
                'application/manifest+json',
            ],
            'image/x-icon' => [
                'image/x-icon',
                'image/x-icon',
            ],
            'font/woff2' => [
                'font/woff2',
                'font/woff2',
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
