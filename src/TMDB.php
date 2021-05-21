<?php

namespace JM\TMDB;

use Illuminate\Support\Facades\Http;

class TMDB
{
    private $base = "https://api.themoviedb.org/3";
    private $access_token;

    public function __construct()
    {
        $this->access_token = config('tmdb.access_token');
    }

    private function getRequest($url)
    {
        return
            Http::acceptJson()
                ->withToken($this->access_token)
                ->get($url)
                ->throw()
                ->json();
    }

    /**
     * Get the primary information about a movie.
     * @param int $movie_id
     * @return array
     */
    public function getMovie(int $movie_id): array
    {
        return $this->getRequest("{$this->base}/movie/{$movie_id}");
    }
}