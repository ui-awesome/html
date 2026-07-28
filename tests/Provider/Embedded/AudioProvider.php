<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Embedded;

use Closure;
use UIAwesome\Html\Attribute\Values\{Attribute, Crossorigin};
use UIAwesome\Html\Embedded\Audio;
use UIAwesome\Html\Embedded\Values\{Controlslist, Preload};
use UIAwesome\Html\Helper\Enum;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Embedded\AudioTest} test cases.
 */
final class AudioProvider
{
    /**
     * @return array<string, array{Controlslist|string, string}>
     */
    public static function controlslist(): array
    {
        return [
            'nodownload' => [
                'nodownload',
                'nodownload',
            ],
            'nofullscreen' => [
                'nofullscreen',
                'nofullscreen',
            ],
            'noremoteplayback' => [
                'noremoteplayback',
                'noremoteplayback',
            ],
            'NODOWNLOAD' => [
                Controlslist::NODOWNLOAD,
                'nodownload',
            ],
            'NOFULLSCREEN' => [
                Controlslist::NOFULLSCREEN,
                'nofullscreen',
            ],
            'NOREMOTEPLAYBACK' => [
                Controlslist::NOREMOTEPLAYBACK,
                'noremoteplayback',
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
     * Rows carry the rejected value because the token-list paths report the offending token, not the whole input.
     *
     * @return array<string, array{Closure(): Audio, string, string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'controlslist' => [
                static fn(): Audio => Audio::tag()->controlslist('invalid-value'),
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ],
            'controlslist with empty token before invalid token' => [
                static fn(): Audio => Audio::tag()->controlslist("nodownload\t\ninvalid-value"),
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ],
            'controlslist with invalid token list' => [
                static fn(): Audio => Audio::tag()->controlslist('nodownload invalid-value'),
                'invalid-value',
                'controlslist',
                self::validControlslistValues(),
            ],
            'controlslist with padded single token' => [
                static fn(): Audio => Audio::tag()->controlslist(' nodownload'),
                ' nodownload',
                'controlslist',
                self::validControlslistValues(),
            ],
            'crossorigin' => [
                static fn(): Audio => Audio::tag()->crossorigin('invalid-value'),
                'invalid-value',
                Attribute::CROSSORIGIN->value,
                implode("', '", Enum::normalizeStringArray(Crossorigin::cases())),
            ],
            'preload' => [
                static fn(): Audio => Audio::tag()->preload('invalid-value'),
                'invalid-value',
                'preload',
                implode("', '", Enum::normalizeStringArray(Preload::cases())),
            ],
        ];
    }

    /**
     * @return array<string, array{Preload|string, string}>
     */
    public static function preload(): array
    {
        return [
            'auto' => [
                'auto',
                'auto',
            ],
            'metadata' => [
                'metadata',
                'metadata',
            ],
            'none' => [
                'none',
                'none',
            ],
            'AUTO' => [
                Preload::AUTO,
                'auto',
            ],
            'METADATA' => [
                Preload::METADATA,
                'metadata',
            ],
            'NONE' => [
                Preload::NONE,
                'none',
            ],
        ];
    }

    private static function validControlslistValues(): string
    {
        return implode("', '", Enum::normalizeStringArray(Controlslist::cases()));
    }
}
