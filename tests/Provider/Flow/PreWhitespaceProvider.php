<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Flow;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Flow\PreWhitespaceTest} test cases.
 */
final class PreWhitespaceProvider
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function content(): array
    {
        return [
            'empty' => ['', "<pre>\n</pre>"],
            'encoded text' => ['A & <b> &amp;', '<pre>A &amp; &lt;b&gt; &amp;amp;</pre>'],
            'indentation and trailing spaces' => ["\tfirst  \n  second ", "<pre>\tfirst  \n  second </pre>"],
            'leading LF' => ["\nvalue", "<pre>\n\nvalue</pre>"],
            'leading CR' => ["\rvalue", "<pre>\n\rvalue</pre>"],
            'leading CRLF' => ["\r\nvalue", "<pre>\n\r\nvalue</pre>"],
            'multibyte text' => ["Å\n\n你好\n", "<pre>Å\n\n你好\n</pre>"],
            'only LF' => ["\n", "<pre>\n\n</pre>"],
            'plain' => ['value', '<pre>value</pre>'],
            'repeated LF' => ["first\n\nsecond", "<pre>first\n\nsecond</pre>"],
            'trailing LF' => ["value\n", "<pre>value\n</pre>"],
        ];
    }
}
