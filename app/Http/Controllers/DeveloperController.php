<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{


    private $developers;

    public function __construct()
    {
        $this->developers = json_decode(file_get_contents(storage_path() . "/ejemplo.json"), true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Developer::all();
        return $this->developers;
    }

    public function filter(Request $request)
    {
        // $developers = Developer::when($request->email, function ($query) use ($request){
        //     return $query->where('email','like',"%{$request->email}%");
        // })->get();

        // return $developers;

        $developerFilter = [];

        foreach ($this->developers as $developer){
            if (str_contains($developer['email'], $request->email))
                $developerFilter[] = $developer;
        }

        return $developerFilter;

    }

    public function api($min = 0, $max = 99999999)
    {
        // $developers = Developer::whereBetween('salary', [$min, $max])->get();
        // return $developers;


        $developerFilter = [];

        foreach ($this->developers as $developer){
            if ($developer['salary'] >= $min && $developer['salary'] <= $max)
                $developerFilter[] = $developer;
        }

        return $developerFilter;
    }
}
