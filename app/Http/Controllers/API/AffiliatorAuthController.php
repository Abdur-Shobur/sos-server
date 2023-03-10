<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class AffiliatorAuthController extends Controller
{
     public function AffiliatorRegister(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191|unique:users,email',
            'number'=>'required',
            'password'=>'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
               'validation_errors'=>$validator->messages(),
            ]);
        }
        else
        {

            $role_as = '3';
            $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
             'role_as'=>$role_as,
            'number'=>$request->number,
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

    public function AffiliatorLogin(Request $request)
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
                    'message' => 'Affiliator account is inactive please contact Admin Panel',
                ]);
            }

            else
            {
                if($user->role_as == 3) //1= Admin
                {
                    $role = 'affiliator';
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
}
