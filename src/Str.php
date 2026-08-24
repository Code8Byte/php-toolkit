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

    /**
     * Generate a random alphanumeric string of a given length.
     */
    public static function randomString(int $length = 16): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $max = strlen($chars) - 1;
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, $max)];
        }

        return $result;
    }

    /**
     * Validate an Indonesian NIK (16-digit national ID number) format.
     * Checks length and structure only, not against government records.
     */
    public static function isValidNik(string $nik): bool
    {
        if (!preg_match('/^\d{16}$/', $nik)) {
            return false;
        }

        $day = (int) substr($nik, 6, 2);
        $month = (int) substr($nik, 8, 2);

        // Female NIKs encode day as day+40
        $day = $day > 40 ? $day - 40 : $day;

        return $day >= 1 && $day <= 31 && $month >= 1 && $month <= 12;
    }
}
