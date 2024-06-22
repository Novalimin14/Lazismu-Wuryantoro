<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Mail\KaryawanMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;                                                
use Illuminate\Foundation\Auth\AuthenticatesUsers;                                                 
class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // use AuthenticatesUsers;
    public function index()
    {
        //
        $data = Karyawan::All();
        return view('pages.karyawan', [
            "data" => $data
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:karyawans',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = Karyawan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_plain' => $request->password
        ]);

        // Kirim email setelah registrasi
        Mail::to($user->email)->send(new KaryawanMail($user->nama, $user->email, $user->password_plain));

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $karyawan = Karyawan::findOrFail($id);
        return view('pages.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:karyawans,email,' . $id,
            'password' => 'nullable|string|min:8'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nama = $request->nama;
        $karyawan->email = $request->email;
    
        if ($request->password) {
            $karyawan->password = Hash::make($request->password);
            $karyawan->password_plain = $request->password;
        }
    
        $karyawan->save();
    
        return redirect()->route('karyawan.index')->with('success', 'Karyawan updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan Deleted successfully');

    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:karyawans',
            'password' => 'required|string|min:8'
        ]);
 
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = Karyawan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_plain' => $request->password
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // public function login(Request $request)
    // {
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Jika validasi gagal, kembalikan respon dengan pesan error
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     // Coba untuk melakukan otentikasi dengan email dan password yang diberikan
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         // Jika otentikasi gagal, kembalikan respon dengan pesan Unauthorized
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }

    //     // Jika otentikasi berhasil, dapatkan user yang telah diotentikasi
    //     $karyawan = Auth::Karyawan();

    //     // Buat token untuk user
    //     $token = $karyawan->createToken('auth_token')->plainTextToken;

    //     // Kembalikan respon dengan pesan login berhasil dan token
    //     return response()->json([
    //         'message' => 'Login success',
    //         'access_token' => $token,
    //         'token_type' => 'Bearer'
    //     ]);
    // }
    public function login(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Jika validasi gagal, kembalikan respon dengan pesan error
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Cari user berdasarkan email
    $user = Karyawan::where('email', $request->email)->first();

    // Jika email tidak terdaftar, kembalikan respons error
    if (!$user) {
        return response()->json(['message' => 'Email tidak terdaftar'], 401);
    }

    // Periksa apakah password cocok
    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Password salah'], 401);
    }

    // Jika otentikasi berhasil, buat token untuk user
    $token = $user->createToken('auth_token')->plainTextToken;

    // Kembalikan respon dengan pesan login berhasil dan token
    return response()->json([
        'nama' => $user->nama, // Sesuaikan dengan atribut nama dari model Karyawan Anda
        'message' => 'Login success',
        'access_token' => $token,
        'token_type' => 'Bearer'
    ]);
}

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // public function logout()
    // {
    //     Auth::user()->tokens()->delete();
    //     return response()->json([
    //         'message' => 'logout success'
    //     ]);
    // }
}
