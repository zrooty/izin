<?php

namespace App\Services;

class CutiService
{
    public function hmin($min = 7, $format = 'Y-m-d')
    {
        $min += 1;
        return date_create("+{$min} days")->format($format);
    }
}
