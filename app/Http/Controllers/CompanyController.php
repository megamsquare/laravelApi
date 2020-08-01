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

    public function create(Request $request) {
        // Validate Length & not empty
        $validate = $request->validate([
            'company_name' => 'required|min:3|max:100',
            'company_address' => 'required|min:6|max:200',
            'company_code' => 'required|min:3|max:50'
        ]);
    }

    public function edit() {}

    public function delete() {}
}
