<?php

namespace App\Http\Controllers;

use App\Services\Tmbd\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        return response()->json([
            ['id' => 1, 'name' => 'Lagoa Azul']
        ]);
    }

    public function discover()
    {

        $data = new Movie();
        $data = $data->discover();

        if(!$data)
            return response()->json([
                'status' => 'error',
                'message' => 'Some unknown error happened trying to discover movies'
            ], 404);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);

    }

    public function top_rated()
    {

        $data = new Movie();
        $data = $data->top_rated();

        if(!$data)
            return response()->json([
                'status' => 'error',
                'message' => 'Some unknown error happened tying to get top rated movies'
            ], 404);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);

    }

    public function upcoming()
    {

        $data = new Movie();
        $data = $data->upcoming();

        if(!$data)
            return response()->json([
                'status' => 'error',
                'message' => 'Some unknown error happened tying to get upcoming movies'
            ], 404);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);

    }
}
