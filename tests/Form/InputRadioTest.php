<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Type};
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Tests\Provider\Form\CheckedProvider;
use UnitEnum;

use function str_replace;

/**
 * Unit tests for {@see InputRadio} rendering and checked state behavior.
 */
#[Group('form')]
final class InputRadioTest extends TestCase
{
    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::RADIO,
                'class' => 'value',
            ],
            InputRadio::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" autofocus>
            HTML,
            InputRadio::tag()
                ->autofocus(true)
                ->id('inputradio')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithChecked(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" checked>
            HTML,
            InputRadio::tag()
                ->checked(true)
                ->id('inputradio')
                ->render(),
            "'checked' must be serialized.",
        );
    }

    /**
     * @phpstan-param mixed[]|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    #[DataProviderExternal(CheckedProvider::class, 'checked')]
    public function testRenderWithCheckedAndValue(
        bool|float|int|string|array|Stringable|UnitEnum|null $checked,
        bool|float|int|string|Stringable|UnitEnum|null $value,
        string $expected,
    ): void {
        // CheckedProvider returns checkbox-flavored expected HTML; adapt for radio.
        $expected = str_replace(
            ['inputcheckbox', 'type="checkbox"'],
            ['inputradio', 'type="radio"'],
            $expected,
        );

        self::assertSame(
            $expected,
            InputRadio::tag()
                ->checked($checked)
                ->id('inputradio')
                ->value($value)
                ->render(),
            'checked and value must be serialized together.',
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputradio" type="radio">
            HTML,
            InputRadio::tag(['class' => 'default-class'])
                ->id('inputradio')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithRequired(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" required>
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->required(true)
                ->render(),
            "'required' must be serialized.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" tabindex="1">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="radio">
            HTML,
            (string) InputRadio::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputradio" type="radio" value="value">
            HTML,
            InputRadio::tag()
                ->id('inputradio')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $inputRadio = InputRadio::tag();

        self::assertNotSame(
            $inputRadio,
            $inputRadio->checked(true),
            'New instance must be returned (immutability).',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenSettingTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                '-2',
                GlobalAttribute::TABINDEX->value,
                'value >= -1',
            ),
        );

        InputRadio::tag()->tabIndex(-2);
    }
}
