<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\FormControl\Form;

use UIAwesome\Html\FormControl\Form;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Form::widget();

        $this->assertNotSame($instance, $instance->action(''));
        $this->assertNotSame($instance, $instance->csrf('value'));
        $this->assertNotSame($instance, $instance->enctype('application/x-www-form-urlencoded'));
        $this->assertNotSame($instance, $instance->method('GET'));
        $this->assertNotSame($instance, $instance->noValidate());
    }
}
