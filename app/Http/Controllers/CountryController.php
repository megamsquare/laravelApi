<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('jwt', ['except' => ['']]);
    }
    //

    public function index() {
        // Return all Country regardless of use
        $country = Country::orderby('create_at')->get();
        return response()->json([$country]);
    }

    public function create(Request $request) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
