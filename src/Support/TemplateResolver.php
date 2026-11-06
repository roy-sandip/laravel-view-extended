<?php
namespace RoySandip\LaravelViewCommands\Support;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;
use InvalidArgumentException;

class TemplateResolver
{
    public function __construct(protected Factory $views, protected Filesystem $files)
    {

    }

    /**
     * Resolve a Laravel view name and return its source contents.
     *
     * Examples:
     * - layouts.admin
     * - invoices.partials.form
     * - vendor::package.layout
     */
    public function getContents(string $view): string
    {
        try {
            
            $path = $this->views->getFinder()->find($view);

        }catch(InvalidArgumentException $exception){
            
            throw new InvalidArgumentException("Template view [{$view}] could not be found. Check the view name and configured view paths.", previous: $exception);
        }

        return $this->files->get($path);
    }
}
