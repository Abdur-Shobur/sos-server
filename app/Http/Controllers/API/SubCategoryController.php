<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
        public function SubCategoryIndex()
    {
        $subcategory=Subcategory::all();
        return response()->json([
            'status'=>200,
            'subcategory'=>$subcategory,
        ]);
    }

    public function SubCategoryStore(Request $request)
    {

           $validator=Validator::make($request->all(),[

               'name' => 'required|unique:subcategories|max:255',
               'category_id'=>'required',
        ]);

          if ($validator->fails()) {
               return response()->json([
                'status'=>400,
               'errors'=>$validator->messages(),
            ]);
          }

          else
          {
            $subcategory =new Subcategory;
            $subcategory->category_id=$request->input('category_id');
            $subcategory->name=$request->input('name');
            $subcategory->slug =Str::slug($request->name);
            $subcategory->status=$request->input('status');
            $subcategory->save();
            return response()->json([
            'status'=>200,
             'message'=>'SubCategory Added Sucessfully',
            ]);
          }
    }

    public function SubCategoryEdit($id)
    {
         $subcategory = Subcategory::find($id);
          if($subcategory)
          {
            return response()->json([
                'status'=>200,
                'subcategory'=>$subcategory
            ]);
         }
         else
          {
            return response()->json([
                'status'=>404,
                'message'=>'No Subcategory Id Found'
            ]);
        }
    }

    public function UpdateSubCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                  'name'=>'required|max:191',
                  'category_id'=>'required|max:191',
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
                  $subcategory = Subcategory::find($id);
                  if($subcategory)
                  {

                      $subcategory->name = $request->input('name');
                      $subcategory->slug =Str::slug($request->name);
                      $subcategory->category_id = $request->input('category_id');
                      $subcategory->status = $request->input('status');
                      $subcategory->save();
                      return response()->json([
                          'status'=>200,
                          'message'=>'Sub Category Updated Successfully',
                      ]);
                  }
                  else
                  {
                      return response()->json([
                          'status'=>404,
                          'message'=>'No Sub Category ID Found',
                      ]);
                  }

              }
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        if($subcategory)
        {
            $subcategory->delete();
            return response()->json([
                'status'=>200,
                'message'=>'SubCategory Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No SubCategory ID Found',
            ]);
        }
    }
}
