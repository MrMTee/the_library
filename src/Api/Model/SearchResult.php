<?php

declare(strict_types=1);

namespace App\Api\Model;

final class SearchResult
{
    public function __construct(
        public string $Title,
        public string $Year,
        public string $imdbID,
        public string $Poster
    ) {
    }
}
