<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class JwtAuthController extends Controller
{
    /**
     * @var AuthService $authService
     * @var User $userModel
     */
    private $authService;
    private $userModel;

    /**
     * Create a new JwtAuthController instance
     *
     * @return void
     */
    public function __construct(AuthService $authService, User $userModel)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService = $authService;
        $this->userModel = $userModel;
    }

    /**
     * Register new user
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        try {
            $user = $this->authService->storeUser($request);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred...',
                'error' => $exception->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'User successfully registered!',
            'user' => $user->makeHidden('updated_at')
        ], 201);
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        try {
            $token = auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error occurred...',
                'error' => $exception->getMessage()
            ], 500);
        }

        if ($token) {
            return response()->json([
                'message' => 'User successfully logged in!',
                'token' => $token,
                'user' => auth()->user()->makeHidden('updated_at')
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthorised!'
        ], 401);
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out!']);
    }
}
