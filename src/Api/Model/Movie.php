<?php

declare(strict_types=1);

namespace App\Api\Model;

final class Movie
{
    public function __construct(
        public readonly string $Title,
        public readonly string $ImdbID
    ) {
    }
}
