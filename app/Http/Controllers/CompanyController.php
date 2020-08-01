<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CompanyController extends Controller
{
    //
    public function index() {
        // Return all Companies regardless of user
        $country = Country::orderby('created_at')->get();
        return response()->json(['country' => $country]);
    }

    public function create() {}

    public function edit() {}

    public function delete() {}
}
