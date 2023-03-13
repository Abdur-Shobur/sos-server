<?php

namespace App\Http\Controllers\API\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{

    public function AffiliatorProfile()
    {
        $user=User::find(Auth::user()->id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    public function AffiliatorUpdateProfile(Request $request)
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
            $file->move('uploads/vendor/', $filename);
            $data->image = 'uploads/vendor/'.$filename;
        }

        $data->save();
        return response()->json([
        'status'=>200,
         'message'=>'Affiliator Update Sucessfully',
        ]);
    }




        public function AffiliatorProducts()
        {
            $product=Product::with('category','subcategory')->where('status','active')->get();
            return response()->json([
                'status'=>200,
                'product'=>$product,
            ]);
        }

        public function AffiliatorProductSingle($id)
        {
            $product = Product::find($id);
            if($product)
            {
              return response()->json([
                  'status'=>200,
                  'product'=>$product
              ]);
           }
           else
            {
              return response()->json([
                  'status'=>404,
                  'message'=>'No Product Id Found'
              ]);
          }
        }

        public function AffiliatorProductRequest(Request $request,$id)
        {
            $product=Product::find($id);
            $product->request =0;
            $product->user_type =Auth::id();

            $product->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Product Request Successfully Please Wait',
                ]);
        }


        public function  AffiliatorProductPendingProduct()
        {
                  $userId =Auth::id();
                    $pending=Product::with('category','subcategory')->where('user_type',$userId)->where('request',0)->get();
                    return response()->json([
                    'status'=>200,
                    'pending'=>$pending,
                ]);
        }

        public function AffiliatorProductActiveProduct()
        {
            $userId =Auth::id();
            $active=Product::with('category','subcategory')->where('user_type',$userId)->where('request',1)->get();
            return response()->json([
            'status'=>200,
            'active'=>$active,
        ]);
        }



}
