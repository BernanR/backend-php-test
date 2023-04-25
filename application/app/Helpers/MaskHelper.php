<?php

namespace App\Helpers;

use Exception;

class MaskHelper
{
    /**
     * Determine if the user is authorized to make this request.
     */
    static function removeMoneyMask($price): float
    {
        $price = trim(str_replace(['R$', "$"], "", $price));
        $price = (preg_match('/,/', $price)) ? str_replace(",", ".", str_replace(".", "", $price)) : $price;
        $price = (float) $price;

        if (is_float($price)) {
            return $price;
        }

        abort(400, "Error: Campo preço é inválido.");
    }
}
