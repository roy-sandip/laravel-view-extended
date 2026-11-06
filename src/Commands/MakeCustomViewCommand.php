<?php
namespace RoySandip\LaravelViewCommands\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\ViewMakeCommand;
use RoySandip\LaravelViewCommands\Support\TemplateResolver;

class MakeCustomViewCommand extends ViewMakeCommand
{
    protected $signature = 'make:custom-view
        {name : The name of the view}
        {--extension=blade.php : The extension of the generated view}
        {--f|force : Create the view even if the view already exists}
        {--cp= : Copy the contents of an existing view}';

    protected $description = 'Create a view with optional template copying';

    public function __construct(Filesystem $files, protected TemplateResolver $templateResolver)
    {
        parent::__construct($files);
    }

    /**
     * Build the generated view contents.
     *
     * Without --cp, Laravel's native ViewMakeCommand behavior is retained.
     */
    protected function buildClass($name): string
    {
        $template = $this->option('cp');

        if (!$template)
        {
            return parent::buildClass($name);
        }

        return $this->templateResolver->getContents($template);
    }
}
