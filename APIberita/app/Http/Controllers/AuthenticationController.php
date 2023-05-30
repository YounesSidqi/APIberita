<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        return $user->createToken('token')->plainTextToken;
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged out'
        ]);
    }

    public function profile(Request $request) {

        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    }

    public function editprofile(Request $request, $user_id) {

        $user = User::where('id', $user_id)->first();

        if (! $user) {
            return response([
                'message' => ['Akun tidak terdaftar!']
            ], 404);
        }

        $user->update([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]); 

        return response()->json([
            'status' => 'berhasil',
            'data' => $user
        ], 200);
    }

    public function deleteprofile($user_id) {

        $user = User::where('id', $user_id)->first();

        if (! $user) {
            return response([
                'message' => ['Akun tidak terdaftar!']
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => "berhasil",
            'pesan' => "$user->username, Berhasil dihapus"
        ], 200);
    }

    public function register(Request $request) {

        $pesan = [
            'required' => 'jangan kasih kosong bang',
            'email' => 'email kau mana lah',
            'unique' => 'sudah ada bng, ganti yg lain',
            'confirmed' => 'LAH KOK BEDA',
        ];

        $request->validate([
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ], $pesan);

        $user = User::create([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' =>'Selamat, anda berhasil mendaftar',
            'data' => $user
        ]);
    }

    public function allusers() {
        $user = User::all();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    

    
}
