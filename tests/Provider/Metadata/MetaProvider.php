<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use UIAwesome\Html\Attribute\Values\{Charset, HttpEquiv};

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\MetaTest} test cases.
 */
final class MetaProvider
{
    /**
     * @return array<string, array{Charset|string, string}>
     */
    public static function charset(): array
    {
        return [
            'big5' => [
                'big5',
                'big5',
            ],
            'euc-jp' => [
                'euc-jp',
                'euc-jp',
            ],
            'euc-kr' => [
                'euc-kr',
                'euc-kr',
            ],
            'gb2312' => [
                'gb2312',
                'gb2312',
            ],
            'gbk' => [
                'gbk',
                'gbk',
            ],
            'iso-2022-jp' => [
                'iso-2022-jp',
                'iso-2022-jp',
            ],
            'iso-8859-1' => [
                'iso-8859-1',
                'iso-8859-1',
            ],
            'iso-8859-15' => [
                'iso-8859-15',
                'iso-8859-15',
            ],
            'iso-8859-2' => [
                'iso-8859-2',
                'iso-8859-2',
            ],
            'iso-8859-6' => [
                'iso-8859-6',
                'iso-8859-6',
            ],
            'iso-8859-7' => [
                'iso-8859-7',
                'iso-8859-7',
            ],
            'iso-8859-8' => [
                'iso-8859-8',
                'iso-8859-8',
            ],
            'iso-8859-9' => [
                'iso-8859-9',
                'iso-8859-9',
            ],
            'koi8-r' => [
                'koi8-r',
                'koi8-r',
            ],
            'koi8-u' => [
                'koi8-u',
                'koi8-u',
            ],
            'shift_jis' => [
                'shift_jis',
                'shift_jis',
            ],
            'utf-16' => [
                'utf-16',
                'utf-16',
            ],
            'utf-16be' => [
                'utf-16be',
                'utf-16be',
            ],
            'utf-16le' => [
                'utf-16le',
                'utf-16le',
            ],
            'utf-32' => [
                'utf-32',
                'utf-32',
            ],
            'utf-32be' => [
                'utf-32be',
                'utf-32be',
            ],
            'utf-32le' => [
                'utf-32le',
                'utf-32le',
            ],
            'utf-8' => [
                'utf-8',
                'utf-8',
            ],
            'windows-1251' => [
                'windows-1251',
                'windows-1251',
            ],
            'windows-1252' => [
                'windows-1252',
                'windows-1252',
            ],
            'windows-1253' => [
                'windows-1253',
                'windows-1253',
            ],
            'windows-1254' => [
                'windows-1254',
                'windows-1254',
            ],
            'windows-1255' => [
                'windows-1255',
                'windows-1255',
            ],
            'windows-1256' => [
                'windows-1256',
                'windows-1256',
            ],
            'BIG5' => [
                Charset::BIG5,
                'big5',
            ],
            'EUC_JP' => [
                Charset::EUC_JP,
                'euc-jp',
            ],
            'EUC_KR' => [
                Charset::EUC_KR,
                'euc-kr',
            ],
            'GB2312' => [
                Charset::GB2312,
                'gb2312',
            ],
            'GBK' => [
                Charset::GBK,
                'gbk',
            ],
            'ISO_2022_JP' => [
                Charset::ISO_2022_JP,
                'iso-2022-jp',
            ],
            'ISO_8859_1' => [
                Charset::ISO_8859_1,
                'iso-8859-1',
            ],
            'ISO_8859_15' => [
                Charset::ISO_8859_15,
                'iso-8859-15',
            ],
            'ISO_8859_2' => [
                Charset::ISO_8859_2,
                'iso-8859-2',
            ],
            'ISO_8859_6' => [
                Charset::ISO_8859_6,
                'iso-8859-6',
            ],
            'ISO_8859_7' => [
                Charset::ISO_8859_7,
                'iso-8859-7',
            ],
            'ISO_8859_8' => [
                Charset::ISO_8859_8,
                'iso-8859-8',
            ],
            'ISO_8859_9' => [
                Charset::ISO_8859_9,
                'iso-8859-9',
            ],
            'KOI8_R' => [
                Charset::KOI8_R,
                'koi8-r',
            ],
            'KOI8_U' => [
                Charset::KOI8_U,
                'koi8-u',
            ],
            'SHIFT_JIS' => [
                Charset::SHIFT_JIS,
                'shift_jis',
            ],
            'UTF_16' => [
                Charset::UTF_16,
                'utf-16',
            ],
            'UTF_16BE' => [
                Charset::UTF_16BE,
                'utf-16be',
            ],
            'UTF_16LE' => [
                Charset::UTF_16LE,
                'utf-16le',
            ],
            'UTF_32' => [
                Charset::UTF_32,
                'utf-32',
            ],
            'UTF_32BE' => [
                Charset::UTF_32BE,
                'utf-32be',
            ],
            'UTF_32LE' => [
                Charset::UTF_32LE,
                'utf-32le',
            ],
            'UTF_8' => [
                Charset::UTF_8,
                'utf-8',
            ],
            'WINDOWS_1251' => [
                Charset::WINDOWS_1251,
                'windows-1251',
            ],
            'WINDOWS_1252' => [
                Charset::WINDOWS_1252,
                'windows-1252',
            ],
            'WINDOWS_1253' => [
                Charset::WINDOWS_1253,
                'windows-1253',
            ],
            'WINDOWS_1254' => [
                Charset::WINDOWS_1254,
                'windows-1254',
            ],
            'WINDOWS_1255' => [
                Charset::WINDOWS_1255,
                'windows-1255',
            ],
            'WINDOWS_1256' => [
                Charset::WINDOWS_1256,
                'windows-1256',
            ],
        ];
    }

    /**
     * @return array<string, array{HttpEquiv|string, string}>
     */
    public static function httpEquiv(): array
    {
        return [
            'content-security-policy' => [
                'content-security-policy',
                'content-security-policy',
            ],
            'content-type' => [
                'content-type',
                'content-type',
            ],
            'default-style' => [
                'default-style',
                'default-style',
            ],
            'refresh' => [
                'refresh',
                'refresh',
            ],
            'x-ua-compatible' => [
                'x-ua-compatible',
                'x-ua-compatible',
            ],
            'CONTENT_SECURITY_POLICY' => [
                HttpEquiv::CONTENT_SECURITY_POLICY,
                'content-security-policy',
            ],
            'CONTENT_TYPE' => [
                HttpEquiv::CONTENT_TYPE,
                'content-type',
            ],
            'DEFAULT_STYLE' => [
                HttpEquiv::DEFAULT_STYLE,
                'default-style',
            ],
            'REFRESH' => [
                HttpEquiv::REFRESH,
                'refresh',
            ],
            'X_UA_COMPATIBLE' => [
                HttpEquiv::X_UA_COMPATIBLE,
                'x-ua-compatible',
            ],
        ];
    }
}
