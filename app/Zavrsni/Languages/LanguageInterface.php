<?php namespace Zavrsni\Languages;

interface LanguageInterface {
    public function set($language);
    public function configureLocale();
}