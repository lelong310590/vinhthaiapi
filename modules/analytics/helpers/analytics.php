<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 26/03/2019
 * Time: 13:56
 */
if (!function_exists('convertISOCountry')) {
    function convertISOCountry($code) {
        $content = file_get_contents(__DIR__.'./../country.json');
        $countryList = json_decode($content, true);

        $result = array_search($code, $countryList);

        return $result;
    }
}

if (!function_exists('formatSeconds')) {
    function formatSeconds( $seconds )
    {
        $hours = 0;
        $milliseconds = str_replace( "0.", '', $seconds - floor( $seconds ) );

        if ( $seconds > 3600 )
        {
            $hours = floor( $seconds / 3600 );
        }
        $seconds = $seconds % 3600;


        return str_pad( $hours, 2, '0', STR_PAD_LEFT )
            . gmdate( ':i:s', $seconds )
            . ($milliseconds ? ".$milliseconds" : '')
            ;
    }
}
