<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ColorController extends Controller
{
    public function ColorIndex()
    {
        $color=Color::all();
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
            $color->slug =Str::slug($request->name);
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
         $color = Color::find($id);
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

        $color = Color::find($id);
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