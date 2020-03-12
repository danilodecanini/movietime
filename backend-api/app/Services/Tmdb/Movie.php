<?php

namespace App\Services\Tmbd;

use Exception;
use Illuminate\Support\Facades\Http;

class Movie {

    private $api_key;

    public function __construct()
    {
        if(env('TMDB_KEY')){
            $this->api_key = env('TMDB_KEY');
        } else {
            throw new Exception("There is not TMDB API KEY available");
        }
    }

    public function discover()
    {
        $response = Http::get('https://api.themoviedb.org/3/discover/movie?api_key=' . $this->api_key);

        if($response->successful())
            return $response->json();
    }

    public function top_rated()
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key=' . $this->api_key);

        if($response->successful())
            return $response->json();

    }

    public function upcoming()
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/upcoming?api_key=' . $this->api_key);

        if($response->successful())
            return $response->json();

    }

    public function details($movie_id)
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/'. $movie_id . '?api_key=' . $this->api_key);

        if($response->successful())
            return $response->json();
    }

}
