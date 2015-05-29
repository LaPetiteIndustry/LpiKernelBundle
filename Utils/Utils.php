<?php

namespace Lpi\KernelBundle\Utils;

class Utils
{

    public static function slugify($text)
    {
        if (empty($text)) {
            return 'n-a';
        }

        $urlize = new Urlize();
        return $urlize->urlize($text);
    }
}

