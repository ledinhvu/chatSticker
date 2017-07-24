<?php

namespace App\Components;

class Util
{

    public static function theExcerpt($string, $length = 100)
    {		
        // strip tags to avoid breaking any html
		$string = strip_tags($string);

		if (strlen($string) > $length) {

		    // truncate string
		    $stringCut = substr($string, 0, $length);

		    // make sure it ends in a word so assassinate doesn't become ass...
		    $string = $stringCut.'...'; 
		}
		return $string;
    }
}
