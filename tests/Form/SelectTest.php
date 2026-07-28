<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPForge\Support\Stub\{BackedInteger, BackedString};
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\Autocomplete;
use UIAwesome\Html\Form\{Optgroup, Option, Select};
use UIAwesome\Html\Tests\Provider\Form\SelectProvider;

/**
 * Unit tests for {@see Select} rendering and option selection behavior.
 *
 * {@see SelectProvider} for test case data providers.
 */
#[Group('form')]
final class SelectTest extends TestCase
{
    public function testContentEncodesValues(): void
    {
        self::assertSame(
            '&lt;value&gt;',
            Select::tag()
                ->content('<value>')
                ->getContent(),
            'Content must be HTML-encoded.',
        );
    }

    #[TestWith(['on'], 'string')]
    #[TestWith([Autocomplete::ON], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value): void
    {
        self::assertSame(
            <<<HTML
            <select autocomplete="on">
            </select>
            HTML,
            Select::tag()
                ->autocomplete($value)
                ->render(),
            "'autocomplete' must be serialized.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">Dog</option>
            </select>
            HTML,
            Select::tag()
                ->html('<option value="dog">Dog</option>')
                ->render(),
            'Inline content must be rendered.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <select class="default-class">
            </select>
            HTML,
            Select::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <select disabled>
            </select>
            HTML,
            Select::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <select form="value">
            </select>
            HTML,
            Select::tag()
                ->form('value')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithMultiple(): void
    {
        self::assertSame(
            <<<HTML
            <select multiple>
            </select>
            HTML,
            Select::tag()
                ->multiple(true)
                ->render(),
            "'multiple' must be serialized.",
        );
    }

    public function testRenderWithMultipleAndNullValue(): void
    {
        self::assertSame(
            <<<HTML
            <select multiple>
            <option value="dog">
            Dog
            </option>
            </select>
            HTML,
            Select::tag()
                ->multiple(true)
                ->option(
                    Option::tag()->selected(true)->value('dog')->content('Dog'),
                )
                ->value(null)
                ->render(),
            '`null` must clear the selection instead of failing the array constraint.',
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <select name="value">
            </select>
            HTML,
            Select::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithOptgroup(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <optgroup label="Chile">
            <option value="1">
            Santiago
            </option>
            </optgroup>
            </select>
            HTML,
            Select::tag()
                ->optgroup(
                    Optgroup::tag()
                        ->label('Chile')
                        ->option(Option::tag()->value('1')->content('Santiago')),
                )
                ->render(),
            'Optgroup must be appended.',
        );
    }

    public function testRenderWithOption(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="1">
            Santiago
            </option>
            </select>
            HTML,
            Select::tag()
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
            <select>
            Before<option value="1">
            Santiago
            </option>
            After
            </select>
            HTML,
            Select::tag()
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
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="cat">
            Cat
            </option>
            <option value="hamster">
            Hamster
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->value('dog')->content('Dog'),
                    Option::tag()->value('cat')->content('Cat'),
                    Option::tag()->value('hamster')->content('Hamster'),
                )
                ->render(),
            'Options collection must be applied.',
        );
    }

    public function testRenderWithoutValuePreservesOptionSelection(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog" selected>
            Dog
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->selected(true)->value('dog')->content('Dog'),
                )
                ->render(),
            'Option-level selection must be preserved when select value is not configured.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <select required>
            </select>
            HTML,
            Select::tag()
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithSelectedValue(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="cat" selected>
            Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->value('dog')->content('Dog'),
                    Option::tag()->value('cat')->content('Cat'),
                )
                ->value('cat')
                ->render(),
            'Selected value must mark the matching option.',
        );
    }

    public function testRenderWithSelectedValueAsSingleElementArray(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="cat" selected>
            Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->value('dog')->content('Dog'),
                    Option::tag()->value('cat')->content('Cat'),
                )
                ->value(['cat'])
                ->render(),
            'A single-element array must be accepted without `multiple`.',
        );
    }

    public function testRenderWithSelectedValueClearsExistingSelection(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="cat" selected>
            Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->selected(true)->value('dog')->content('Dog'),
                    Option::tag()->value('cat')->content('Cat'),
                )
                ->value('cat')
                ->render(),
            'Configured value must replace option-level selection.',
        );
    }

    public function testRenderWithSelectedValueInOptgroup(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <optgroup label="Pets">
            <option value="dog">
            Dog
            </option>
            <option value="cat" selected>
            Cat
            </option>
            </optgroup>
            </select>
            HTML,
            Select::tag()
                ->optgroup(
                    Optgroup::tag()
                        ->label('Pets')
                        ->options(
                            Option::tag()->value('dog')->content('Dog'),
                            Option::tag()->value('cat')->content('Cat'),
                        ),
                )
                ->value('cat')
                ->render(),
            'Selected value must be applied to grouped options.',
        );
    }

    public function testRenderWithSelectedValueMatchingOptionText(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option selected>
            Dog
            </option>
            <option>
            Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->content('Dog'),
                    Option::tag()->content('Cat'),
                )
                ->value('Dog')
                ->render(),
            'Option without a `value` attribute must match on its submitted text.',
        );
    }

    public function testRenderWithSelectedValueMatchingOptionTextCollapsingWhitespace(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option selected>
            \tDog\r\n and\f  Cat\x20
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->html("\tDog\r\n and\f  Cat "),
                )
                ->value('Dog and Cat')
                ->render(),
            'ASCII whitespace must be stripped and collapsed before matching.',
        );
    }

    public function testRenderWithSelectedValueMatchingOptionTextContainingEntity(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option selected>
            Dog &amp; Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->content('Dog & Cat'),
                )
                ->value('Dog & Cat')
                ->render(),
            'Encoded text must be decoded before matching.',
        );
    }

    public function testRenderWithSelectedValueMatchingOptionTextContainingQuoteEntity(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option selected>
            Dog &apos;n Cat
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->html('Dog &apos;n Cat'),
                )
                ->value("Dog 'n Cat")
                ->render(),
            'HTML5 quote entities must be decoded before matching.',
        );
    }

    public function testRenderWithSelectedValueMatchingOptionTextIgnoringMarkup(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option selected>
            <b>Dog</b>
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->html('<b>Dog</b>'),
                )
                ->value('Dog')
                ->render(),
            'Markup must be excluded from the matched text.',
        );
    }

    public function testRenderWithSelectedValuePreservesOptionValue(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="yes">
            Yes
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->value('yes')->content('Yes'),
                )
                ->value('no')
                ->render(),
            'Selected value must not overwrite the submitted option value.',
        );
    }

    public function testRenderWithSelectedValues(): void
    {
        self::assertSame(
            <<<HTML
            <select multiple>
            <option value="1" selected>
            One
            </option>
            <option value="2">
            Two
            </option>
            <option value="3" selected>
            Three
            </option>
            </select>
            HTML,
            Select::tag()
                ->multiple(true)
                ->options(
                    Option::tag()->value(1)->content('One'),
                    Option::tag()->value(2)->content('Two'),
                    Option::tag()->value(3)->content('Three'),
                )
                ->value(['1', 3])
                ->render(),
            'Multiple selected values must mark every matching option.',
        );
    }

    public function testRenderWithSelectedValueUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="value" selected>
            Value
            </option>
            </select>
            HTML,
            Select::tag()
                ->option(
                    Option::tag()->value('value')->content('Value'),
                )
                ->value(BackedString::VALUE)
                ->render(),
            'Selected value must mark the matching option.',
        );
    }

    #[TestWith([4, 4], 'int')]
    #[TestWith([BackedInteger::VALUE, 1], 'enum')]
    public function testRenderWithSize(int|BackedInteger $value, int $expected): void
    {
        self::assertSame(
            <<<HTML
            <select size="{$expected}">
            </select>
            HTML,
            Select::tag()
                ->size($value)
                ->render(),
            "'size' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            </select>
            HTML,
            (string) Select::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValueNullClearsExistingSelection(): void
    {
        self::assertSame(
            <<<HTML
            <select>
            <option value="dog">
            Dog
            </option>
            <option value="null">
            Null
            </option>
            </select>
            HTML,
            Select::tag()
                ->options(
                    Option::tag()->selected(true)->value('dog')->content('Dog'),
                    Option::tag()->selected(true)->value('null')->content('Null'),
                )
                ->value(null)
                ->render(),
            'Null selected value must clear option-level selection.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $select = Select::tag();

        self::assertNotSame(
            $select,
            $select->option(Option::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $select,
            $select->optgroup(Optgroup::tag()->label('group')),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $select,
            $select->options(Option::tag()->value('dog')->content('Dog')),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $select,
            $select->value('dog'),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @phpstan-param Closure(): string $setter
     */
    #[DataProviderExternal(SelectProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(Closure $setter, string $expected): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expected);

        $setter();
    }
}
