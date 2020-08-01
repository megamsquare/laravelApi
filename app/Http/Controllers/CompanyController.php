<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index() {
        // Return all Companies regardless of user
        $company = Company::orderby('created_at')->get();
        return response()->json(['company' => $company]);
    }

    public function create() {}

    public function edit() {}

    public function delete() {}
}
