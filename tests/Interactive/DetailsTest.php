<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Interactive;

use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Interactive\Details;
use UIAwesome\Html\Interactive\Summary;

/**
 * Unit tests for {@see Details} rendering and disclosure attribute behavior.
 */
#[Group('interactive')]
final class DetailsTest extends TestCase
{
    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <details>
            value
            </details>
            HTML,
            Details::tag()
                ->content('value')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <details class="default-class">
            </details>
            HTML,
            Details::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    #[TestWith(['requirements', 'requirements'], 'string')]
    #[TestWith([BackedString::VALUE, 'value'], 'enum')]
    public function testRenderWithName(string|BackedString $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <details name="{$expected}">
            </details>
            HTML,
            Details::tag()
                ->name($value)
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithOpen(): void
    {
        self::assertSame(
            <<<HTML
            <details open>
            </details>
            HTML,
            Details::tag()
                ->open(true)
                ->render(),
            "'open' must be serialized.",
        );
    }

    public function testRenderWithSummary(): void
    {
        self::assertSame(
            <<<HTML
            <details>
            <summary>
            System requirements
            </summary>
            </details>
            HTML,
            Details::tag()
                ->summary('System requirements')
                ->render(),
            'Summary must accept a string.',
        );
    }

    public function testRenderWithSummaryUsingElement(): void
    {
        self::assertSame(
            <<<HTML
            <details>
            <summary>
            System requirements
            </summary>
            </details>
            HTML,
            Details::tag()
                ->summary(Summary::tag()->content('System requirements'))
                ->render(),
            'Summary must accept a Summary instance.',
        );
    }

    public function testRenderWithSummaryUsingNull(): void
    {
        self::assertSame(
            <<<HTML
            <details>
            </details>
            HTML,
            Details::tag()
                ->summary(null)
                ->render(),
            'Summary must accept `null` to drop the element.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <details>
            </details>
            HTML,
            (string) Details::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $details = Details::tag();

        self::assertNotSame(
            $details,
            $details->open(null),
            'New instance must be returned (immutability).',
        );
    }
}
