<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Embedded;

use UIAwesome\Html\Embedded\Values\Kind;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Embedded\TrackTest} test cases.
 */
final class TrackProvider
{
    /**
     * @return array<string, array{Kind|string, string}>
     */
    public static function kind(): array
    {
        return [
            'captions' => [
                'captions',
                'captions',
            ],
            'chapters' => [
                'chapters',
                'chapters',
            ],
            'descriptions' => [
                'descriptions',
                'descriptions',
            ],
            'metadata' => [
                'metadata',
                'metadata',
            ],
            'subtitles' => [
                'subtitles',
                'subtitles',
            ],
            'CAPTIONS' => [
                Kind::CAPTIONS,
                'captions',
            ],
            'CHAPTERS' => [
                Kind::CHAPTERS,
                'chapters',
            ],
            'DESCRIPTIONS' => [
                Kind::DESCRIPTIONS,
                'descriptions',
            ],
            'METADATA' => [
                Kind::METADATA,
                'metadata',
            ],
            'SUBTITLES' => [
                Kind::SUBTITLES,
                'subtitles',
            ],
        ];
    }
}
