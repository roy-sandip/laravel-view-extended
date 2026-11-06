# Laravel View Commands

Additional Artisan commands for generating Laravel views. This package **does not replace or modify** Laravel's built-in `make:view` command.

## Requirements

- PHP 8.3+
- Laravel 13+

## Installation

### Install from a local folder

Extract or clone this package beside your Laravel application. Add a path repository to your application's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../laravel-view-extended",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "roy-sandip/laravel-view-extended": "*"
    }
}
```

Then run:

```bash
composer update roy-sandip/laravel-view-extended
```

### Install from GitHub

After publishing this repository to GitHub, add this to your application's `composer.json`:

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

For a stable release, create and push a version tag (for example `v1.0.0`) and require `^1.0` instead of `dev-main`.

Laravel package discovery automatically registers the service provider.

## Commands

### Laravel's original command remains available

```bash
php artisan make:view invoices.index
```

### Generate a view from an existing view template

```bash
php artisan make:custom-view invoices.index --cp=layouts.page-template
```

The `--cp` value is a Laravel view name, not a filesystem path. The view finder resolves it using the application's configured view paths and namespaces.

Other examples:

```bash
php artisan make:custom-view invoices.create --cp=layouts.form
php artisan make:custom-view shipments.index --cp=layouts.admin
php artisan make:custom-view invoices.index --cp=layouts.page-template --force
```

The command inherits Laravel's native view generator behavior and options, including `--extension` and `--force`. When `--cp` is omitted, the parent command's normal behavior is used.

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

Keep `make:custom-view` as the package command so Laravel's native `make:view` remains untouched.

## License

MIT
