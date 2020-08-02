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
            'company_code' => 'required|min:3|max:50|unique:companies,company_code'
        ]);
        if ($request->all()) {
            $company = Company::create([
                'company_name' => $request['company_name'],
                'company_address' => $request['company_address'],
                'company_code' => $request['company_code']
                // 'company_code' => $date->format('Y-m-d') . "-" . str_pad($company->id, 6, "0", STR_PAD_LEFT)
            ]);
            return response()->json(['message' => 'Create Successful'], 200);
        }
    }

    public function edit(Request $request, $id) {
        $company = Company::findOrFail($id);
        $validate = null;

        if ($company) {
            // Validate Length & not empty
            $validate = $request->validate([
                'company_name' => 'required|min:3|max:100',
                'company_address' => 'required|min:6|max:200',
                'company_code' => 'required|min:3|max:50|unique:companies,company_code'
            ]);
            if ($validate) {
                $company->update($request->all());
                return response()->json(['message' => 'Update Successful'], 200);
            }
        } else {
            return response()->json(['error' => 'Could not update company details'], 401);
        }
    }

    public function delete($id) {
        $company = Company::findOrFail($id);
        if($company) {
            $company->delete();
            return response()->json(['message' => 'Delete Successful'], 200);
        } else {
            return response()->json(['error' => 'Could not delete company details'], 401);
        }
    }
}
