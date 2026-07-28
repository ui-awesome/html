<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\BackedInteger;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocomplete, Type};
use UIAwesome\Html\Form\InputText;
use UIAwesome\Html\Tests\Provider\Form\InputTextProvider;

/**
 * Unit tests for {@see InputText} rendering and text field attribute behavior.
 *
 * {@see InputTextProvider} for test case data providers.
 */
#[Group('form')]
final class InputTextTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputText::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::TEXT,
                'class' => 'value',
            ],
            InputText::tag()
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
            <input id="inputtext" type="text" autocomplete="on">
            HTML,
            InputText::tag()
                ->autocomplete($value)
                ->id('inputtext')
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" autofocus>
            HTML,
            InputText::tag()
                ->autofocus(true)
                ->id('inputtext')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputtext" type="text">
            HTML,
            InputText::tag(['class' => 'default-class'])
                ->id('inputtext')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithDirname(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" dirname="comment.dir">
            HTML,
            InputText::tag()
                ->dirname('comment.dir')
                ->id('inputtext')
                ->render(),
            "'dirname' must be serialized.",
        );
    }

    public function testRenderWithList(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" list="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->list('value')
                ->render(),
            "'list' must be serialized.",
        );
    }

    public function testRenderWithMaxlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" maxlength="10">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->maxlength(10)
                ->render(),
            "'maxlength' must be serialized.",
        );
    }

    public function testRenderWithMinlength(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" minlength="5">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->minlength(5)
                ->render(),
            "'minlength' must be serialized.",
        );
    }

    public function testRenderWithPattern(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" pattern='[A-Za-z]{3}'>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->pattern('[A-Za-z]{3}')
                ->render(),
            "'pattern' must be serialized.",
        );
    }

    public function testRenderWithPlaceholder(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" placeholder="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->placeholder('value')
                ->render(),
            "'placeholder' must be serialized.",
        );
    }

    public function testRenderWithReadonly(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" readonly>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->readonly(true)
                ->render(),
            "'readonly' must be serialized.",
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" required>
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    #[TestWith([20, 20], 'int')]
    #[TestWith([BackedInteger::VALUE, 1], 'enum')]
    public function testRenderWithSize(int|BackedInteger $value, int $expected): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" size="{$expected}">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" spellcheck="true">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->spellcheck(true)
                ->render(),
            "'spellcheck' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" tabindex="1">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="text">
            HTML,
            (string) InputText::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputtext" type="text" value="value">
            HTML,
            InputText::tag()
                ->id('inputtext')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    /**
     * @phpstan-param Closure(): InputText $setter
     */
    #[DataProviderExternal(InputTextProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
