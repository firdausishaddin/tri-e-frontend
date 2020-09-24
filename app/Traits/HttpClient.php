<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait HttpClient 
{
    protected $url = 'http://tri-e-backend.test';

    public function postClient(Array $arr)
    {
        $response = Http::post($this->url, $arr);

        return $response;
    }
}