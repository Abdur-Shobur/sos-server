<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ColorController extends Controller
{
    public function ColorIndex()
    {

        $userId =Auth::id();
        $color=Color::where('user_id',$userId)->get();
        return response()->json([
            'status'=>200,
            'color'=>$color,
        ]);
    }

    public function Colortore(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:colors|max:255',
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
            $color =new Color();
            $color->name=$request->input('name');
            $color->code=$request->input('code');
            $color->slug =Str::slug($request->name);
            $color->user_id=Auth::id();
            $color->status='pending';
            $color->save();
            return response()->json([
            'status'=>200,
             'message'=>'Color Added Sucessfully',
            ]);
          }
    }

    public function ColorEdit($id)
    {
        $userId =Auth::id();
         $color = Color::where('user_id',$userId)->find($id);
        if($color)
        {
            return response()->json([
                'status'=>200,
                'color'=>$color
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Color Id Found'
            ]);
        }
    }

    public function ColorUpdate(Request $request, $id)
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
                $color = Color::find($id);
                if($color)
                {

                    $color->name = $request->input('name');
                    $color->slug =Str::slug($request->name);
                    $color->status = $request->input('status');
                    $color->code=$request->input('code');
                    $color->user_id=Auth::id();
                    $color->save();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Color Updated Successfully',
                    ]);
                }
                else
                {
                    return response()->json([
                        'status'=>404,
                        'message'=>'No Color ID Found',
                    ]);
                }

            }
    }

    public function destroy($id)
    {
        $userId =Auth::id();
        $color = Color::where('user_id',$userId)->find($id);
        if($color)
        {
            $color->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Color Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No COlor ID Found',
            ]);
        }
    }



}
