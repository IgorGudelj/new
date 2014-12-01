<?php namespace Zavrsni\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->view->composer('layouts.partials.header', 'Zavrsni\Composers\HeaderComposer');
        $this->app->view->composer('layouts.partials.footer', 'Zavrsni\Composers\FooterComposer');
    }

} 