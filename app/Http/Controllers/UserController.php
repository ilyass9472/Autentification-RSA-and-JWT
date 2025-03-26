<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function index(){
        try{
            $user = User::paginate(10);
            return response()->json($user);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'firstname'=>'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6',
            'role'=>'required|string',
            'code'=>'required|string|max:255',
        ]);

        $user = User::create([
            'firstname'=> $validatedData['firstname'],
            'lastname'=> $validatedData['lastname'],
            'email'=> $validatedData['email'],
            'password'=> bcrypt($validatedData['password']),
            'role'=> $validatedData['role'],
            'code'=> $validatedData['code'],
        ]);

        $token = auth()->login($user);

        $qrCode = QrCode::size(300)->generate(url('/user/' . $user->id));

        return response()->json([
            'success'=>true,
            'message'=>'User created successfully',
            'token'=> $token,
            'data'=> $user,
            'qr_code' => base64_encode($qrCode),
        ],201);
    }

    public function show(){
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ],404);
        }
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);

    }

    public function update(Request $request){
        $user = auth()->user();

        $validatedData = $request->validate([
            'firstname'=>'sometimes|required|string|max:255',
            'lastname'=>'sometimes|required|string|max:255',
            'email'=>'sometimes|required|email|unique:users,email,' . $user->id,
            'password'=>'sometimes|nullable|string|min:6',
            'role'=>'sometimes|required|string',
            'code'=>'sometimes|required|string|max:255',
        ]);

        if(isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        $qrCode = QrCode::size(300)->generate(url('/user/' . $user->id));

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
            'qr_code' => base64_encode($qrCode),
        ]);

    }

    public function destroy()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

}
