<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Form;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Form\Fieldset;

/**
 * Unit tests for {@see Fieldset} rendering and attribute behavior.
 */
#[Group('form')]
final class FieldsetTest extends TestCase
{
    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::assertSame(
            <<<HTML
            <fieldset class="default-class">
            </fieldset>
            HTML,
            Fieldset::tag(['class' => 'default-class'])->render(),
            'Constructor configuration must be applied.',
        );
    }

    public function testRenderWithDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <fieldset disabled>
            </fieldset>
            HTML,
            Fieldset::tag()
                ->disabled(true)
                ->render(),
            "'disabled' must be serialized.",
        );
    }

    public function testRenderWithForm(): void
    {
        self::assertSame(
            <<<HTML
            <fieldset form="profile-form">
            </fieldset>
            HTML,
            Fieldset::tag()
                ->form('profile-form')
                ->render(),
            "'form' must be serialized.",
        );
    }

    public function testRenderWithName(): void
    {
        self::assertSame(
            <<<HTML
            <fieldset name="contact-group">
            </fieldset>
            HTML,
            Fieldset::tag()
                ->name('contact-group')
                ->render(),
            "'name' must be serialized.",
        );
    }

    public function testRenderWithToString(): void
    {
        self::assertSame(
            <<<HTML
            <fieldset>
            </fieldset>
            HTML,
            (string) Fieldset::tag(),
            'Casting to string must produce HTML.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $fieldset = Fieldset::tag();

        self::assertNotSame(
            $fieldset,
            $fieldset->disabled(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $fieldset,
            $fieldset->form('profile-form'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $fieldset,
            $fieldset->name('contact-group'),
            'New instance must be returned (immutability).',
        );
    }
}
