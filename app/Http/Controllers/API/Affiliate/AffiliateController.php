<?php

namespace App\Http\Controllers\API\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{


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
