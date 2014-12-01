<?php namespace Zavrsni\Languages;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Whoops\Example\Exception;

class Language implements LanguageInterface{

    public function set($language)
    {
        if ( in_array( $language, Config::get('app.languages')) ) {
            App::setLocale($language);
            $cookie = Cookie::forever( 'language', $language );
            Cookie::queue( $cookie );
        } else {
            throw new Exception('Language not found');
        }

    }

    public function configureLocale()
    {
        $language = Cookie::get( 'language' );
        if ( $language != null )
        {
            if ( in_array( $language, Config::get('app.languages')) ) {
                App::setLocale( $language );
            } else {
                throw new Exception('Language not found');
            }
        }
    }
}