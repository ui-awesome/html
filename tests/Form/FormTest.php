<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use Closure;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group, TestWith};
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Autocapitalize, Autocomplete, Rel, Target};
use UIAwesome\Html\Form\Form;
use UIAwesome\Html\Form\Values\{Enctype, Method};
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Tests\Provider\Form\FormProvider;

/**
 * Unit tests for {@see Form} rendering and attribute behavior.
 *
 * {@see FormProvider} for test case data providers.
 */
#[Group('form')]
final class FormTest extends TestCase
{
    public function testRenderWithAcceptCharset(): void
    {
        self::assertSame(
            <<<HTML
            <form accept-charset="UTF-8">
            </form>
            HTML,
            Form::tag()
                ->acceptCharset('UTF-8')
                ->render(),
            "'accept-charset' must be serialized.",
        );
    }

    public function testRenderWithAction(): void
    {
        self::assertSame(
            <<<HTML
            <form action="/submit">
            </form>
            HTML,
            Form::tag()
                ->action('/submit')
                ->render(),
            "'action' must be serialized.",
        );
    }

    #[DataProviderExternal(FormProvider::class, 'autocapitalize')]
    public function testRenderWithAutocapitalize(string|Autocapitalize $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form autocapitalize="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->autocapitalize($value)
                ->render(),
            "'autocapitalize' must be serialized.",
        );
    }

    /**
     * The `autocomplete` attribute is free-form: the rows pin both accepted input forms, not a closed value domain.
     */
    #[TestWith(['on', 'on'], 'string')]
    #[TestWith([Autocomplete::ON, 'on'], 'enum')]
    public function testRenderWithAutocomplete(string|Autocomplete $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form autocomplete="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->autocomplete($value)
                ->render(),
            "'autocomplete' must be serialized from both input forms.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <form class="default-class">
            </form>
            HTML,
            Form::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    #[DataProviderExternal(FormProvider::class, 'enctype')]
    public function testRenderWithEnctype(string|Enctype $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form enctype="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->enctype($value)
                ->render(),
            "'enctype' must be serialized.",
        );
    }

    #[DataProviderExternal(FormProvider::class, 'method')]
    public function testRenderWithMethod(string|Method $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form method="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->method($value)
                ->render(),
            "'method' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <form name="value">
            </form>
            HTML,
            Form::tag()
                ->name('value')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithNovalidate(): void
    {
        self::assertSame(
            <<<HTML
            <form novalidate>
            </form>
            HTML,
            Form::tag()
                ->novalidate(true)
                ->render(),
            "'novalidate' must be serialized.",
        );
    }

    #[DataProviderExternal(FormProvider::class, 'rel')]
    public function testRenderWithRel(string|Rel $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form rel="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->rel($value)
                ->render(),
            "'rel' must be serialized.",
        );
    }

    #[DataProviderExternal(FormProvider::class, 'target')]
    public function testRenderWithTarget(string|Target $value, string $expected): void
    {
        self::assertSame(
            <<<HTML
            <form target="{$expected}">
            </form>
            HTML,
            Form::tag()
                ->target($value)
                ->render(),
            "'target' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <form>
            </form>
            HTML,
            (string) Form::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $form = Form::tag();

        self::assertNotSame(
            $form,
            $form->acceptCharset(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->action(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->enctype(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->method(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $form,
            $form->novalidate(true),
            'New instance must be returned (immutability).',
        );
    }

    /**
     * @param Closure(): Form $setter
     */
    #[DataProviderExternal(FormProvider::class, 'invalidAttributeValues')]
    public function testThrowInvalidArgumentExceptionForInvalidAttributeValue(
        Closure $setter,
        string $attribute,
        string $allowedValues,
    ): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage('invalid-value', $attribute, $allowedValues),
        );

        $setter();
    }
}
