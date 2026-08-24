# php-toolkit

Small, dependency-free PHP helper functions for strings, currency formatting, and text truncation. No framework required — works standalone or inside Laravel/any PHP project.

## Install

```bash
composer require code8byte/php-toolkit
```

## Usage

```php
use Codebyte\PhpToolkit\Str;

Str::maskEmail('john@gmail.com');        // jo***@gmail.com
Str::formatRupiah(1500000);              // Rp 1.500.000
Str::slugify('Produk Kopi & Susu!');     // produk-kopi-susu
Str::truncate('The quick brown fox', 12);// The quick...
```

## Testing

```bash
composer install
composer test
```

## Contributing

Issues and pull requests are welcome. Feel free to open a PR with new helper functions or fixes.

## License

MIT
