<?php

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;

class MaskHelper
{
    /**
     * Determine if the user is authorized to make this request.
     */
    static function removeMoneyMask($price): float
    {
        return (preg_match('/,/', $price)) ? str_replace(",", ".", str_replace(".", "", $price)) : $price;
    }
}
