<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\{Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputHidden;

/**
 * Unit tests for {@see InputHidden} rendering and hidden value behavior.
 */
#[Group('form')]
final class InputHiddenTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputHidden::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::HIDDEN,
                'class' => 'value',
            ],
            InputHidden::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    #[TestWith(['on'], 'string')]
    #[TestWith([Autocomplete::ON], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" autocomplete="on">
            HTML,
            InputHidden::tag()
                ->autocomplete($value)
                ->id('inputhidden')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag(['class' => 'default-class'])
                ->id('inputhidden')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="hidden">
            HTML,
            (string) InputHidden::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputhidden" type="hidden" value="value">
            HTML,
            InputHidden::tag()
                ->id('inputhidden')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }
}
