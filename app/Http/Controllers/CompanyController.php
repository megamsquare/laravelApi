<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('jwt', ['except' => ['']]);
    }
    //
    public function index() {
        // Return all Companies regardless of user
        $company = Company::orderby('created_at')->get();
        return response()->json([$company]);
    }

    public function create(Request $request) {
        // Validate Length & not empty
        $validate = $request->validate([
            'company_name' => 'required|min:3|max:100',
            'company_address' => 'required|min:6|max:200',
            'company_code' => 'required|min:3|max:50'
        ]);

        if ($validate) {
            if ($request->all()) {
                $company = Company::create($request->all());
                return reponse()->json(['success' => true], 200);
            }
        } else {
            return response()->json([
                'error' => [
                    'root' => $validate
                ]
            ]);
        }
    }

    public function edit() {}

    public function delete() {}
}
