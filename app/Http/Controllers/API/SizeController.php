<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Size;
class SizeController extends Controller
{
    public function SizeIndex()
    {
        $userId =Auth::id();
        $size=Size::where('user_id',$userId)->get();
        return response()->json([
            'status'=>200,
            'size'=>$size,
        ]);
    }

    public function Sizestore(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:sizes|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
          else
          {
            $size =new Size();
            $size->name=$request->input('name');
            $size->slug =Str::slug($request->name);
            $size->user_id=Auth::id();
            $size->status='pending';
            $size->save();
            return response()->json([
            'status'=>200,
             'message'=>'Size Added Sucessfully',
            ]);
          }
    }

    public function SizeEdit($id)
    {
        $userId =Auth::id();
         $size = Size::where('user_id',$userId)->find($id);
        if($size)
        {
            return response()->json([
                'status'=>200,
                'size'=>$size
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Size Id Found'
            ]);
        }
    }

    public function SizeUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                        'name'=>'required|max:191',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>422,
                    'errors'=>$validator->messages(),
                ]);
            }
            else
            {
                $size = Size::find($id);
                if($size)
                {

                    $size->name = $request->input('name');
                    $size->slug =Str::slug($request->name);
                    $size->status = $request->input('status');
                    $size->user_id=Auth::id();
                    $size->save();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Size Updated Successfully',
                    ]);
                }
                else
                {
                    return response()->json([
                        'status'=>404,
                        'message'=>'No SIze ID Found',
                    ]);
                }

            }
    }

    public function destroy($id)
    {
        $userId =Auth::id();
        $size = Size::where('user_id',$userId)->find($id);
        if($size)
        {
            $size->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Size Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Size ID Found',
            ]);
        }
    }
}
