<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\TextAreaWhitespaceTest} test cases.
 */
final class TextAreaWhitespaceProvider
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function content(): array
    {
        return [
            'empty' => [
                '',
                "<textarea>\n</textarea>",
            ],
            'encoded text' => [
                'A & "B" <b> &amp; </textarea>',
                '<textarea>A &amp; "B" &lt;b&gt; &amp;amp; &lt;/textarea&gt;</textarea>',
            ],
            'leading LF' => [
                "\nvalue",
                "<textarea>\n\nvalue</textarea>",
            ],
            'multibyte text' => [
                "Å\n\n你好\n",
                "<textarea>Å\n\n你好\n</textarea>",
            ],
            'multiple boundary LF' => [
                "\n\nvalue\n\n",
                "<textarea>\n\n\nvalue\n\n</textarea>",
            ],
            'only LF' => [
                "\n",
                "<textarea>\n\n</textarea>",
            ],
            'plain' => [
                'value',
                '<textarea>value</textarea>',
            ],
            'repeated LF' => [
                "first\n\nsecond",
                "<textarea>first\n\nsecond</textarea>",
            ],
            'trailing LF' => [
                "value\n",
                "<textarea>value\n</textarea>",
            ],
            'zero' => [
                '0',
                '<textarea>0</textarea>',
            ],
        ];
    }
}
