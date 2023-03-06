<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
class AdminController extends Controller
{
    public function AdminProfile()
    {
        $user=User::find(Auth::user()->id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    public function AdminUpdateProfile(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->number = $request->number;
        $data->status = $request->status;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() .'.'.$extension;
            $file->move('uploads/admin/', $filename);
            $data->image = 'uploads/admin/'.$filename;
        }

        $data->save();
        return response()->json([
        'status'=>200,
         'message'=>'Admin Update Sucessfully',
        ]);
    }

    public function AdminRequestPending()
    {
         $product=Product::where('request','0')->get();
            return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function AdminRequestActive()
    {
         $product=Product::where('request','1')->get();
            return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function AdminRequestBalances()
    {
        $user=User::where('balance_status',0)->get();
        return response()->json($user);
    }


    public function AdminRequestBalanceActive()
    {
        $user=User::where('balance_status',1)->get();
        return response()->json($user);
    }





}
