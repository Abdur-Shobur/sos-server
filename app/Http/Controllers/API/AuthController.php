<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191|unique:users,email',
            'password'=>'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
               'validation_errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $role_as = '2';
            $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role_as'=>$role_as,
            'status'=>'pending',


            'password'=>Hash::make($request->password),
          ]);

             $token = $user->createToken($user->email.'_Token')->plainTextToken;

           return response()->json([
               'status'=>200,
               'username'=>$user->name,
               'token'=>$token,
               'message'=>'Register Successfully',
            ]);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|max:191',
            'password'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $user = User::where('email', $request->email)->first();

            if(! $user || ! Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid Credentials',
                ]);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'status' => 401,
                    'message' => 'Account is inactive please Conatct Admin Panel',
                ]);
            }

            else
            {
                if($user->role_as == 1) //1= Admin
                {
                    $role = 'admin';
                    $token = $user->createToken($user->email.'_AdminToken', ['server:admin'])->plainTextToken;
                }
                else
                {
                    $role = '';
                    $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                }

                return response()->json([
                    'status'=>200,
                    'username'=>$user->name,
                    'token'=>$token,
                    'message'=>'Logged In Successfully',
                    'role'=>$role,
                ]);
            }
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Logged Out Successfully',
        ]);
    }

}
