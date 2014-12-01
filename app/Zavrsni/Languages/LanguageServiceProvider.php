<?php namespace Zavrsni\Languages;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->bind('Zavrsni\Languages\LanguageInterface', 'Zavrsni\Languages\Language');
    }
}