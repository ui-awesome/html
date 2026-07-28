<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Values\{Attribute, Autocapitalize, Rel, Target};
use UIAwesome\Html\Form\Form;
use UIAwesome\Html\Form\Values\{Enctype, Method};
use UIAwesome\Html\Helper\Enum;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\FormTest} test cases.
 */
final class FormProvider
{
    /**
     * @return array<string, array{string|Autocapitalize, string}>
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
     * @return array<string, array{string|Enctype, string}>
     */
    public static function enctype(): array
    {
        return [
            'application/x-www-form-urlencoded' => [
                'application/x-www-form-urlencoded',
                'application/x-www-form-urlencoded',
            ],
            'multipart/form-data' => [
                'multipart/form-data',
                'multipart/form-data',
            ],
            'text/plain' => [
                'text/plain',
                'text/plain',
            ],
            'APPLICATION_X_WWW_FORM_URLENCODED' => [
                Enctype::APPLICATION_X_WWW_FORM_URLENCODED,
                'application/x-www-form-urlencoded',
            ],
            'MULTIPART_FORM_DATA' => [
                Enctype::MULTIPART_FORM_DATA,
                'multipart/form-data',
            ],
            'TEXT_PLAIN' => [
                Enctype::TEXT_PLAIN,
                'text/plain',
            ],
        ];
    }

    /**
     * @return array<string, array{Closure(): Form, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'autocapitalize' => [
                static fn(): Form => Form::tag()->autocapitalize('invalid-value'),
                'autocapitalize',
                implode("', '", Enum::normalizeStringArray(Autocapitalize::cases())),
            ],
            'enctype' => [
                static fn(): Form => Form::tag()->enctype('invalid-value'),
                'enctype',
                implode("', '", Enum::normalizeStringArray(Enctype::cases())),
            ],
            'method' => [
                static fn(): Form => Form::tag()->method('invalid-value'),
                'method',
                implode("', '", Enum::normalizeStringArray(Method::cases())),
            ],
            'rel' => [
                static fn(): Form => Form::tag()->rel('invalid-value'),
                Attribute::REL->value,
                implode("', '", Enum::normalizeStringArray(Rel::cases())),
            ],
            'target' => [
                static fn(): Form => Form::tag()->target('invalid-value'),
                Attribute::TARGET->value,
                implode("', '", Enum::normalizeStringArray(Target::cases())),
            ],
        ];
    }

    /**
     * @return array<string, array{string|Method, string}>
     */
    public static function method(): array
    {
        return [
            'dialog' => [
                'dialog',
                'dialog',
            ],
            'get' => [
                'get',
                'get',
            ],
            'post' => [
                'post',
                'post',
            ],
            'DIALOG' => [
                Method::DIALOG,
                'dialog',
            ],
            'GET' => [
                Method::GET,
                'get',
            ],
            'POST' => [
                Method::POST,
                'post',
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
}
