<?php

use Zavrsni\Languages\LanguageInterface;

class LanguageController extends \BaseController {

    protected $language;

    /**
     * Create a new instance of the Language class
     *
     * @param LanguageInterface $language
     * @return \LanguageController
     */
    public function __construct(LanguageInterface $language)
    {
        $this->language = $language;
    }

    /**
     * Action used to set the application locale.
     *
     */
    public function setLocale()
    {
        $lang = Request::segment(2);

        try {
            $this->language->set($lang);
            return Redirect::back();
        } catch (Exception $e) {
            //show error
        }
    }

}