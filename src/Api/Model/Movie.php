<?php

declare(strict_types=1);

namespace App\Api\Model;

final class Movie
{
    public function __construct(
        public readonly string $Title,
        public readonly string $imdbID,
        public readonly string $Director,
        public readonly string $Year,
        public readonly string $Plot = '',
        public readonly string $Poster,
        ...$params
    ) {
    }
}
