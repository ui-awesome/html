<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use Closure;
use UIAwesome\Html\Attribute\Values\{
    AsValue,
    Attribute,
    Blocking,
    Crossorigin,
    ElementAttribute,
    Fetchpriority,
    Referrerpolicy,
    Rel,
    Type,
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
     * @return array<string, array{string|AsValue, string}>
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
     * @return array<string, array{string|Rel, string}>
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
