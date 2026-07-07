<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Support\Stub;

use UIAwesome\Html\Contracts\Element\BlockInterface;
use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Stub defaults provider for tests.
 */
final class DefaultProvider implements DefaultsProviderInterface
{
    /**
     * @phpstan-return mixed[]
     */
    public function getDefaults(BaseTag $tag): array
    {
        return match (true) {
            $tag instanceof BlockInterface => [
                'class' => 'default-class',
            ],
            default => [
                'class' => 'default-class',
                'title' => 'default-title',
            ],
        };
    }
}
