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

    public function create(Request $request) {
        // Validate Lenght & not empty
        $validate = $request->validate([
            'country_name' => 'required|min:3|max:100',
            'country_code' => 'required|min:3|max:50|unique:countries,country_code'
        ]);
        if ($request->all()) {
            $country = Country::create([
                'country_name' => $request['country_name'],
                'country_code' => $request['country_code']
            ]);
            return response()->json(['message' => 'Create Successful'], 200);
        }
    }

    public function update(Request $request, $id) {
        $country = Country::findOrFail($id);
        $validate = null;

        if ($country) {
            // Validate Length & Not Empty
            $validate = $request->validate([
                'country_name' => 'required|min:3|max:100',
                'country_code' => 'required|min:3|max:50|unique:countries,country_code'
            ]);
            if ($validate) {
                $country->update($request->all());
                return response()->json(['message' => 'Update Successful'], 200);
            }
        } else {
            return response()->json(['error' => 'Could not update Country details'], 401);
        }
    }

    public function delete(Request $request) {}
}
