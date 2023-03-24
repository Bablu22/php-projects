<?php

class FormSanitizer
{
    public static function sanitizeFormString($inputText): string
    {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        $inputText = strtolower($inputText);
        return ucfirst($inputText);
    }

    public static function sanitizeFormUsername($inputText): string
    {
        $inputText = strip_tags($inputText);
        return trim($inputText);
    }

    public static function sanitizeFormEmail($inputText): string
    {
        $inputText = strip_tags($inputText);
        return trim($inputText);
    }

    public static function sanitizeFormPassword($inputText): string
    {
        return $inputText = strip_tags($inputText);
    }
}

