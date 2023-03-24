<?php

class ErrorMessage
{
    /**
     * @param $text
     * @return void
     */
    public static function show($text)
    {
        exit("<span class='errorBanner'>$text</span>");
    }
}

