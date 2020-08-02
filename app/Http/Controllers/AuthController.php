<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\SignUpRequest;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('jwt', ['except' => ['login', 'createUser']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * @OA\Post(
     * path="/login",
     * summary="User Sign in endpoint",
     * description="Login by email and password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Email or Password does\'t exist'], 401);
    }




    /**
     * @OA\Post(
     * path="/createUser",
     * summary="User Sign Up endpoint",
     * description="Sign Up user with",
     * operationId="authCreateUser",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     *   @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
    *     )
    *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function createUser(SignUpRequest $request)
    {
        if ($request->all()) {
            $user = User::create($request->all());
            return response()->json(['message' => 'Successful']);
        }
    }

    // public function updateUser(Request $request, $userId)
    // {
    //     $user = User::findOrFail($userId);
    //     // dd($user);
    //     $user->update($request->all());

    //     return $user;
    // }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validate = null;

        if ($user) {
            if (
                $user->email === $request['email'] &&
                $user->username === $request['username'] ||
                $user->username === $request['username'] ||
                $user->email === $request['email']) {

                    $validate = $request->validate([
                        // ^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$
                        'firstname' => 'required|regex:/^\S*$/u|string',
                        'lastname' => 'required|regex:/^\S*$/u|string',
                        'username' => 'required|regex:/^\S*$/u|string',
                        'email' => 'required|email',
                    ]);

            } else {

                $validate = $request->validate([
                    // ^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$
                    'firstname' => 'required|regex:/^\S*$/u|string',
                    'lastname' => 'required|regex:/^\S*$/u|string',
                    'username' => 'required|regex:/^\S*$/u|string',
                    'middlename' => 'regex:/^\S*$/u|string',
                    'email' => 'required|email',
                ]);
            }

            $user->update($request->all());

            return response()->json(['success' => true], 200);

        } else {
            return response()->json(['error' => 'Could not update your details'], 401);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function changePassword() {}

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $status = auth()->user()->status;

        if ($status === 'Active') {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $this->guard()->factory()->getTTL() * 60,
                // 'user_details' => auth()->user()
            ]);
        } elseif ($status === 'Resigned') {
            return response()->json(['error' => 'This User has Resigned'], 401);
        } elseif ($status === 'Retired') {
            return response()->json(['error' => 'This User has Retired'], 401);
        } elseif ($status === 'Fired') {
            return response()->json(['error' => 'This User was Fired'], 401);
        } elseif ($status === 'Dead') {
            return response()->json(['error' => 'This User is Dead'], 401);
        }

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
