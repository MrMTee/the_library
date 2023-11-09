<?php

namespace App\Api\Client;

use App\Api\Model\Movie;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

/** @package App\Api */
class Omdb implements ApiClientInterface
{
    public function __construct(
        private HttpClientInterface $omdbApiClient
    ) {
    }

    public function init($mode, $term)
    {
        return $this->omdbApiClient->request('GET', '/', [
            'query' => [
                $mode => $term,
                'type' => 'movie',
            ]
        ]);
    }

    public function getById($id): Movie
    {

        $result = $this->init('i', $id)->toArray();

        return new Movie(
            Title: $result['Title'],
            ImdbID: $result['imdbID']
        );
    }

    public function search($string): array
    {

        try {

            $results = $this->init('s', $string)->toArray()['Search'];

        } catch (Throwable $throwable) {
            
            throw $throwable;
            
        }

        return array_reduce(
            $results,
            static function ($movieRaw, $result) {
                $movieRaw[$result['imdbID']] = "{$result['Title']}";
                return $movieRaw;
            }
        );;
    }
}
