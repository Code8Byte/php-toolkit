<?php

namespace Codebyte\PhpToolkit\Tests;

use Codebyte\PhpToolkit\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_mask_email(): void
    {
        $this->assertSame('jo***@gmail.com', Str::maskEmail('john@gmail.com'));
        $this->assertSame('pa***@mavyware.my.id', Str::maskEmail('paul@mavyware.my.id'));
        $this->assertSame('not-an-email', Str::maskEmail('not-an-email'));
    }

    public function test_format_rupiah(): void
    {
        $this->assertSame('Rp 1.500.000', Str::formatRupiah(1500000));
        $this->assertSame('Rp 1.500.000,50', Str::formatRupiah(1500000.5, true));
        $this->assertSame('Rp 0', Str::formatRupiah(0));
    }

    public function test_slugify(): void
    {
        $this->assertSame('hello-world', Str::slugify('Hello World'));
        $this->assertSame('produk-kopi-susu', Str::slugify('Produk Kopi & Susu!'));
        $this->assertSame('n-a', Str::slugify('---'));
    }

    public function test_truncate(): void
    {
        $this->assertSame('The quick brown...', Str::truncate('The quick brown fox jumps', 17));
        $this->assertSame('Short text', Str::truncate('Short text', 100));
    }

    public function test_random_string(): void
    {
        $result = Str::randomString(10);
        $this->assertSame(10, strlen($result));
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]+$/', $result);
        $this->assertNotSame(Str::randomString(10), Str::randomString(10));
    }

    public function test_is_valid_nik(): void
    {
        $this->assertTrue(Str::isValidNik('3271011503900001'));
        $this->assertTrue(Str::isValidNik('3271015503900001')); // female DOB encoding
        $this->assertFalse(Str::isValidNik('123'));
        $this->assertFalse(Str::isValidNik('327101ab03900001'));
    }
}
