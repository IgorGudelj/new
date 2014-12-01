<?php namespace Zavrsni\Composers;

use App;
use Sentry;

class FooterComposer {

    public function compose($view)
    {
        $languages = $this->getLanguages();

        $view->withLanguages($languages);
    }

    private function getLanguages()
    {
        $currentLanguage = App::getLocale();
        $languages['hr'] = 'img/flags/icon_language_hr.png';
        $languages['en'] = 'img/flags/icon_language_en.png';

        $languages['current'] = [$currentLanguage => $languages[$currentLanguage]];
        unset($languages[$currentLanguage]);

        return $languages;
    }
}