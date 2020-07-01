<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ResetPasswordController extends Controller
{
    //
    public function sendEmail(Request $request)
    {
        if (!$this->validateEmail($request->email)) {
            return $this->failResponse();
        }

        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email)
    {
        Mail::to($email)->send(new ResetPasswordMail);
    }

    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function failResponse()
    {
        return response()->json([
            'error' => 'Email not found'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'Reset Password is sent successfully to your Email, Please check your email'
        ], Response::HTTP_OK);
    }
}
