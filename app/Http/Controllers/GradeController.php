<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;

class GradeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('jwt', ['except' => ['']]);
    }
    //
    public function index() {
        // Return all Grades regardless of user
        $grade = Grade::orderby('created_at')->get();
        return response()->json([$grade], 200);
    }

    public function create(Request $request) {
        // Validate Length & Not Empty
        $validate = $request->vaidate([
            'grade_name' => 'required|min:3|max:100',
            'grade_code' => 'required|min:3|max:50|unique:companies,company_code'
        ]);
        if ($request->all()) {
            $grade = Grade::create([
                'grade_name' => $request['grade_name'],
                'grade_code' => $request['grade_code']
            ]);
            return response()->json(['message' => 'Created Successfully'], 200);
        }
    }

    public function edit() {}

    public function delete() {}
}
