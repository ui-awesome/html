<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use UIAwesome\Html\Attribute\Values\Target;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\BaseTest} test cases.
 */
final class BaseProvider
{
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
