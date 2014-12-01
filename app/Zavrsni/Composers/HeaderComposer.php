<?php namespace Zavrsni\Composers;

use App;
use Sentry;

class HeaderComposer {

    public function compose($view)
    {
        $view->withUser(Sentry::getUser());
    }
}