<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use App\Http\Controllers\Auth\Request;
// use App\Http\Controllers\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    

    use AuthenticatesUsers;
    public function loginuser(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respon dengan pesan error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Coba untuk melakukan otentikasi dengan email dan password yang diberikan
        if (!Auth::attempt($request->only('email', 'password'))) {
            // Jika otentikasi gagal, kembalikan respon dengan pesan Unauthorized
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Jika otentikasi berhasil, dapatkan user yang telah diotentikasi
        $user = User::where('email', $request->email)->firstOrFail();

        // Buat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Kembalikan respon dengan pesan login berhasil dan token
        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
