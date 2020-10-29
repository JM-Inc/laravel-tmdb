<?php

namespace JM\TMDB;

use Illuminate\Support\Facades\Http;

class TMDB
{
    public $base = 'https://api.themoviedb.org/3';
    public $api_key = '';

    public function __construct()
    {
        $this->api_key = config('tmdb.api_key');
    }

    public static function getImageUrl($image)
    {
        // TODO: replace
        return "https://image.tmdb.org/t/p/w500{$image}";
    }

    public function getMovie(int $movie_id)
    {
        return $this->getRequest("movie/{$movie_id}?append_to_response=videos,images,credits");
    }

    public function getRequest($path)
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->base}/{$path}");
    }

    public function headers()
    {
        return [
            'Authorization' => "Bearer {$this->api_key}",
            'Content-Type' => 'application/json;charset=utf-8',
        ];
    }

    public function getPerson($person_id)
    {
        return $this->getRequest("person/{$person_id}");
    }

    public function getCompany($company_id)
    {
        return $this->getRequest("company/{$company_id}");
    }
}