<?php

namespace App\Http\Controllers\API\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addtocart(Request $request)
    {
        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;
            $product_price = $request->product_price;
            $vendor_id = $request->vendor_id;

            $productCheck = Product::where('id',$product_id)->first();
            if($productCheck)
            {
                if(Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists())
                {
                    return response()->json([
                        'status'=> 409,
                        'message'=> $productCheck->name.' Already Added to Cart',
                    ]);
                }
                else
                {
                    $cartitem = new Cart();
                    $cartitem->user_id = $user_id;
                    $cartitem->product_id = $product_id;
                    $cartitem->product_qty = $product_qty;
                    $cartitem->product_price = $product_price;
                    $cartitem->vendor_id=$vendor_id;
                    $cartitem->save();

                    return response()->json([
                        'status'=> 201,
                        'message'=> 'Added to Cart',
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message'=> 'Product Not Found',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status'=> 401,
                'message'=> 'Login to Add to Cart',
            ]);
        }
    }

    public function viewcart()
    {
        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitems = Cart::where('user_id', $user_id)->get();
            return response()->json([
                'status'=> 200,
                'cart'=> $cartitems,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 401,
                'message'=> 'Login to View Cart Data',
            ]);
        }
    }

    public function deleteCartitem($cart_id)
    {
        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitem = Cart::where('id',$cart_id)->where('user_id',$user_id)->first();
            if($cartitem)
            {
                $cartitem->delete();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Cart Item Removed Successfully.',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message'=> 'Cart Item not Found',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status'=> 401,
                'message'=> 'Login to continue',
            ]);
        }
    }

    public function updatequantity()
    {
        echo"DOne";
    }
}
