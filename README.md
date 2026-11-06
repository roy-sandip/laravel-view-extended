# Laravel View Extended

Additional Artisan commands for generating Laravel views. This package **does not replace or modify** Laravel's built-in `make:view` command.

## Requirements

- PHP 8.3+
- Laravel 13+

## Installation

Install the package through Composer:

```bash
composer require roy-sandip/laravel-view-extended
```

Laravel package discovery automatically registers the service provider.

If the package is not yet published on Packagist, install it directly from GitHub by adding the VCS repository to your application's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/roy-sandip/laravel-view-extended"
        }
    ],
    "require": {
        "roy-sandip/laravel-view-extended": "dev-main"
    }
}
```

Then run:

```bash
composer update roy-sandip/laravel-view-extended
```

Once a stable version is tagged and available through Packagist, the normal `composer require` command above is sufficient.

## Commands

### Laravel's original command remains available

```bash
php artisan make:view invoices.index
```

### Generate a view from an existing view template

```bash
php artisan make:custom-view invoices.index --cp=layouts.page-template
```

The `--cp` value is a Laravel view name, not a filesystem path. Laravel's view finder resolves it using the application's configured view paths and namespaces.

More examples:

```bash
php artisan make:custom-view invoices.create --cp=layouts.form
php artisan make:custom-view shipments.index --cp=layouts.admin
php artisan make:custom-view invoices.index --cp=layouts.page-template --force
```

The custom command inherits Laravel's native view generator behavior and options, including `--extension` and `--force`. When `--cp` is omitted, the parent command's normal behavior is used.

## Package architecture

```text
src/
├── LaravelViewCommandsServiceProvider.php
├── Commands/
│   └── MakeCustomViewCommand.php
└── Support/
    └── TemplateResolver.php
```

- `MakeCustomViewCommand` extends Laravel's `ViewMakeCommand`.
- `TemplateResolver` resolves named Blade views through Laravel's view finder.
- The service provider registers only the additional `make:custom-view` command.

## Extending the package

Add future options to `MakeCustomViewCommand::$signature`. Put reusable logic in dedicated classes under `src/Support`.

Potential future options:

- `--layout=layouts.admin`
- `--section=content`
- `--component`
- `--crud`

The package uses `make:custom-view` so Laravel's native `make:view` remains untouched.

## License

MIT
