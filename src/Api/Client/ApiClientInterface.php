<?php

namespace App\Api\Client;

use App\Api\Model\Movie;

interface ApiClientInterface
{
    public function search($string) : Array;

    public function getById($id) : Movie;
}
