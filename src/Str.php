<?php

namespace Codebyte\PhpToolkit;

class Str
{
    /**
     * Mask an email address for display, e.g. jo***@gmail.com
     */
    public static function maskEmail(string $email): string
    {
        if (!str_contains($email, '@')) {
            return $email;
        }

        [$local, $domain] = explode('@', $email, 2);
        $visible = min(2, strlen($local));
        $masked = substr($local, 0, $visible) . str_repeat('*', max(strlen($local) - $visible, 3));

        return $masked . '@' . $domain;
    }

    /**
     * Format a number as Indonesian Rupiah, e.g. Rp 1.500.000
     */
    public static function formatRupiah(int|float $amount, bool $withDecimals = false): string
    {
        $formatted = number_format($amount, $withDecimals ? 2 : 0, ',', '.');
        return 'Rp ' . $formatted;
    }

    /**
     * Convert a string into a URL-friendly slug.
     */
    public static function slugify(string $text, string $separator = '-'): string
    {
        $text = preg_replace('/[^\pL\d]+/u', $separator, $text);
        $text = trim($text, $separator);
        $text = strtolower($text);
        $text = preg_replace('/[^-\w]+/', '', $text);
        $text = preg_replace('/' . preg_quote($separator, '/') . '+/', $separator, $text);

        return $text === '' ? 'n-a' : $text;
    }

    /**
     * Truncate text to a max length, breaking on the nearest whole word.
     */
    public static function truncate(string $text, int $length = 100, string $suffix = '...'): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }

        $truncated = substr($text, 0, $length);
        $lastSpace = strrpos($truncated, ' ');

        if ($lastSpace !== false) {
            $truncated = substr($truncated, 0, $lastSpace);
        }

        return rtrim($truncated) . $suffix;
    }
}
