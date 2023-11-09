<?php

namespace App\Api\Client;

use Exception;
use Throwable;

class NoResult extends Exception
{

    public function __construct(
        string $message = '',
        ?Throwable $previous = null,
    ){}

    public function forSearch(){
        
    }

    public static function forId(string $imdbId, Throwable $previous){

    }
}
