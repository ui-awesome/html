<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\{Optgroup, Option};

/**
 * Unit tests for {@see Optgroup} rendering and option grouping behavior.
 */
#[Group('form')]
final class OptgroupTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Optgroup::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup class="default-class">
            </optgroup>
            HTML,
            Optgroup::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup disabled>
            </optgroup>
            HTML,
            Optgroup::tag()->disabled(true)->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithLabel(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup label="Chile">
            </optgroup>
            HTML,
            Optgroup::tag()->label('Chile')->render(),
            "'label' must be serialized.",
        );
    }

    public function testRenderWithOption(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            <option value="1">
            Santiago
            </option>
            </optgroup>
            HTML,
            Optgroup::tag()
                ->option(
                    Option::tag()->value('1')->content('Santiago'),
                )
                ->render(),
            'Option must be appended.',
        );
    }

    public function testRenderWithOptionPreservesContentOrder(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            Before<option value="1">
            Santiago
            </option>
            After
            </optgroup>
            HTML,
            Optgroup::tag()
                ->content('Before')
                ->option(
                    Option::tag()->value('1')->content('Santiago'),
                )
                ->content('After')
                ->render(),
            'Option must preserve its position relative to other content.',
        );
    }

    public function testRenderWithOptions(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            <option value="1">
            Santiago
            </option>
            <option value="2">
            Concepcion
            </option>
            </optgroup>
            HTML,
            Optgroup::tag()
                ->options(
                    Option::tag()->value('1')->content('Santiago'),
                    Option::tag()->value('2')->content('Concepcion'),
                )
                ->render(),
            'Options collection must be applied.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <optgroup>
            </optgroup>
            HTML,
            (string) Optgroup::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $optgroup = Optgroup::tag();

        self::assertNotSame(
            $optgroup,
            $optgroup->option(Option::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $optgroup,
            $optgroup->options(Option::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $optgroup,
            $optgroup->selectedValues([]),
            'New instance must be returned (immutability).',
        );
    }
}
