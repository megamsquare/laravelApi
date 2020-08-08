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

    public function create(Request $request) {}

    public function edit() {}

    public function delete() {}
}
