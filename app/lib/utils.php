<?php

if (!function_exists('responseSuccess'))
{
    function responseSuccess(string $message = 'Berhasil menyimpan data') {
        return response()->json([
            'status' => 'success',
            'message'=> $message
        ]);
    }
}