<?php

namespace JM\TMDB;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class TMDB
{
    const API_BASE_PATH = 'https://api.themoviedb.org/3/';
    private $api_key = '';
    private $query = [];

    public function __construct()
    {
        $this->api_key = config('tmdb.api_key');
    }

    public function withCredits()
    {
        $this->query['append_to_response'][] = 'credits';
        return $this;
    }

    public function withVideos()
    {
        $this->query['append_to_response'][] = 'videos';
        return $this;

    }

    public function withImages()
    {
        $this->query['append_to_response'][] = 'images';
        return $this;
    }

    /**
     * @param $path
     * @return string
     *
     * Get image url
     */
    public function getImageUrl($path)
    {
        return "https://image.tmdb.org/t/p/original/{$path}";
    }

    public function withTranslation($language)
    {
        $this->query['append_to_response'][] = "language={$language}";
        return $this;
    }

    /**
     * @param $movie_id
     *
     * Get a movie by id
     */
    public function getMovie($movie_id)
    {
        return $this->getRequest("movie/{$movie_id}?" . $this->getQuery());
    }

    private function getRequest($path)
    {
        return Http::withToken($this->api_key)
            ->acceptJson()
            ->get(self::API_BASE_PATH . $path . $this->getQuery())
            ->json();
    }

    private function getQuery()
    {
        return '?append_to_response=' . collect($this->query)->flatten(1)->implode(',');
    }

    /**
     * @param $person_id
     *
     * Get a person by id
     */
    public function getPerson($person_id)
    {
        return $this->getRequest("person/{$person_id}");
    }

    /**
     * @param $company_id
     *
     * Get a company by id
     */
    public function getCompany($company_id)
    {
        return $this->getRequest("company/{$company_id}");
    }
}