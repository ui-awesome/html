<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\{Datalist, Option};

/**
 * Unit tests for {@see Datalist} rendering and attribute behavior.
 */
#[Group('form')]
final class DatalistTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <datalist class="default-class">
            </datalist>
            HTML,
            Datalist::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithOption(): void
    {
        self::assertSame(
            <<<HTML
            <datalist>
            <option value="1">
            Santiago
            </option>
            </datalist>
            HTML,
            Datalist::tag()
                ->option(Option::tag()->value('1')
                ->content('Santiago'))
                ->render(),
            'Option must be appended.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <datalist>
            </datalist>
            HTML,
            (string) Datalist::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $datalist = Datalist::tag();

        self::assertNotSame(
            $datalist,
            $datalist->option(Option::tag()),
            'New instance must be returned (immutability).',
        );
    }
}
