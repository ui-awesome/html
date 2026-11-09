<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPForge\Support\Stub\BackedString;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use Stringable;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Type};
use UIAwesome\Html\Form\InputRadio;
use UIAwesome\Html\Tests\Provider\Form\{CheckedDefaultsProvider, CheckedProvider};
use UnitEnum;

use function str_replace;

/**
 * Unit tests for {@see InputRadio} rendering and checked state behavior.
 */
#[Group('form')]
final class InputRadioTest extends TestCase
{
    public function testCheckedNullRemovesDefaultAttribute(): void
    {
        $input = InputRadio::tag()
            ->attributes(['checked' => true])
            ->checked(null);

        self::assertArrayNotHasKey(
            'checked',
            $input->getAttributes(),
            'Explicit null must remove the checked attribute.',
        );
        self::assertSame(
            '<input type="radio">',
            $input->render(),
            'Explicit null must render unchecked.',
        );
    }

    /**
     * @param array<string>|bool|string|null $checked
     */
    #[DataProviderExternal(CheckedDefaultsProvider::class, 'inputs')]
    public function testCheckedOverridesAttributeDefaults(
        array|bool|string|null $checked,
        bool $expectedChecked,
        string $expected,
    ): void {
        $expected = str_replace('type="checkbox"', 'type="radio"', $expected);

        $original = InputRadio::tag()
            ->attributes(['checked' => true])
            ->value('active');

        $updated = $original->checked($checked);

        self::assertNotSame(
            $original,
            $updated,
            'Setting checked must return a new instance.',
        );
        self::assertSame(
            $expectedChecked,
            $updated->getAttributes()['checked'] ?? false,
            'Selection must override the preset.',
        );
        self::assertSame(
            $expected,
            $updated->render(),
            'Explicit selection must override checked attributes.',
        );
        self::assertSame(
            $expected,
            $updated->render(),
            'Repeated rendering must preserve selection.',
        );
        self::assertTrue(
            $original->getAttributes()['checked'] ?? null,
            'The original preset must remain checked.',
        );
        self::assertSame(
            '<input type="radio" value="active" checked>',
            $original->render(),
            'The unconfigured original must retain its checked attribute.',
        );
    }

    /**
     * @param array<string>|bool|string|null $checked
     */
    #[DataProviderExternal(CheckedDefaultsProvider::class, 'inputs')]
    public function testCheckedOverridesFactoryDefaults(
        array|bool|string|null $checked,
        bool $expectedChecked,
        string $expected,
    ): void {
        $expected = str_replace('type="checkbox"', 'type="radio"', $expected);

        $original = InputRadio::tag(['attributes' => [['checked' => true]], 'value' => ['active']]);

        $updated = $original->checked($checked);

        self::assertSame(
            $expectedChecked,
            $updated->getAttributes()['checked'] ?? false,
            'Selection must override factory defaults.',
        );
        self::assertSame(
            $expected,
            $updated->render(),
            'Explicit selection must override factory defaults.',
        );
        self::assertSame(
            '<input type="radio" value="active" checked>',
            $original->render(),
            'Unconfigured factory defaults must remain checked.',
        );
    }

    public function testCheckedValueDoesNotChangeOriginal(): void
    {
        $input = InputRadio::tag()->value(BackedString::VALUE);

        $checked = $input->checked('value');

        self::assertNotSame(
            $input,
            $checked,
            'Setting checked must return a new instance.',
        );
        self::assertSame(
            '<input type="radio" value="value">',
            $input->render(),
            'The original typed value must remain unchecked.',
        );
        self::assertSame(
            '<input type="radio" value="value" checked>',
            $checked->render(),
            'The cloned control must match the typed value.',
        );
        self::assertSame(
            BackedString::VALUE,
            $input->getAttribute('value'),
            'The stored value must remain typed.',
        );
    }

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
     * @param bool|float|int|mixed[]|string|Stringable|UnitEnum|null $checked
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

    public function testRepeatedCheckedSettersPreserveIndependentClones(): void
    {
        $original = InputRadio::tag()->attributes(['checked' => true])->value('active');
        $cleared = $original->checked(null);
        $selected = $cleared->checked('active');

        self::assertSame(
            '<input type="radio" value="active">',
            $selected->checked([])->checked([])->render(),
            'Repeated setters must clear a matching selection.',
        );
        self::assertSame(
            '<input type="radio" value="active">',
            $cleared->attributes(['checked' => true])->render(),
            'An explicit cleared selection must take precedence over raw attributes.',
        );
        self::assertSame(
            '<input type="radio" value="other">',
            $selected->value('other')->render(),
            'Changing the value must recompute matching without changing the selected clone.',
        );
        self::assertSame('<input type="radio" value="active" checked>', $selected->render(), 'The matching clone must stay checked.');
        self::assertSame('<input type="radio" value="active">', $cleared->render(), 'The cleared clone must stay unchecked.');
        self::assertSame('<input type="radio" value="active" checked>', $original->render(), 'The original default must stay checked.');
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
