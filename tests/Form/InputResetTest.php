<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{GlobalAttribute, Type};
use UIAwesome\Html\Form\InputReset;

/**
 * Unit tests for {@see InputReset} rendering and reset button behavior.
 */
#[Group('form')]
final class InputResetTest extends TestCase
{
    public function testGetAttributeReturnsDefaultWhenMissing(): void
    {
        self::assertSame(
            'value',
            InputReset::tag()
                ->getAttribute('class', 'value'),
            'Default fallback must be returned.',
        );
    }

    public function testGetAttributesReturnsAssignedAttributes(): void
    {
        self::assertSame(
            [
                'type' => Type::RESET,
                'class' => 'value',
            ],
            InputReset::tag()
                ->addAttribute('class', 'value')
                ->getAttributes(),
            'Assigned attributes must be returned.',
        );
    }

    public function testRenderWithAutofocus(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset" type="reset" autofocus>
            HTML,
            InputReset::tag()
                ->autofocus(true)
                ->id('inputreset')
                ->render(),
            "'autofocus' must be serialized.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <input class="default-class" id="inputreset" type="reset">
            HTML,
            InputReset::tag(['class' => 'default-class'])
                ->id('inputreset')
                ->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset" type="reset">
            HTML,
            InputReset::tag()
                ->id('inputreset')
                ->render(),
            'Bare element must render with no attributes.',
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset" type="reset" tabindex="1">
            HTML,
            InputReset::tag()
                ->id('inputreset')
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <input type="reset">
            HTML,
            (string) InputReset::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testRenderWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <input id="inputreset" type="reset" value="value">
            HTML,
            InputReset::tag()
                ->id('inputreset')
                ->value('value')
                ->render(),
            "'value' must be serialized.",
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

        InputReset::tag()->tabIndex(-2);
    }
}
