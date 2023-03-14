<?php

namespace App\Http\Controllers\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\User;
use App\Models\Subcategory;
use Image;
class VendorController extends Controller
{
     public function VendorProfile()
    {
        $user=User::find(Auth::user()->id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
     }

     public function VendorUpdateProfile(Request $request)
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
          'message'=>'Admin Added Sucessfully',
         ]);
     }


    public function VendorProduct()
    {
        $userId =Auth::id();
        $product=Product::where('user_id',$userId)->get();
        return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }



    public function VendorProductStore(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name' => 'required|unique:products|max:255',
            //  'slug'=>'required',
            'status'=>'required',
            'category_id'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'original_price'=>'required',
     ]);

       if ($validator->fails()) {
            return response()->json([
             'status'=>400,
            'errors'=>$validator->messages(),
         ]);
       }

       else
       {
         $product =new Product;
         $product->category_id=$request->input('category_id');
         $product->subcategory_id=$request->input('subcategory_id');
         $product->brand_id=$request->input('brand_id');
         $product->user_id=Auth::user()->id;
         $product->name=$request->input('name');
         $product->slug =Str::slug($request->name);
         $product->short_description=$request->input('short_description');
         $product->long_description=$request->input('long_description');
         $product->selling_price=$request->input('selling_price');
         $product->original_price=$request->input('original_price');
         $product->qty=$request->input('qty');
         $product->status=$request->input('status');
         $product->meta_title=$request->input('meta_title');
         $product->meta_keyword=$request->input('meta_keyword');
         $product->meta_description=$request->input('meta_description');
        //  $product->tags=$request->input('tags');
         $product->specification      = json_encode($request->specification);
         $product->specification_ans  = json_encode($request->specification_ans);
         $product->tags  = json_encode($request->tags);

         if($request->hasFile('image'))
         {
             $file = $request->file('image');
             $extension = $file->getClientOriginalName();
             $filename = time() .'.'.$extension;
             $file->move('uploads/product/', $filename);
             $product->image = 'uploads/product/'.$filename;
         }
         $product->save();

         $product->colors()->attach($request->colors);
         $product->sizes()->attach($request->sizes);

         $productId=$product->id;
         $images = $request->file('image');
         foreach($images as $image)
         {
            // image01 upload
             $name =  time().'-'.$image->getClientOriginalName();
             $uploadpath = 'uploads/product/';
             $image->move($uploadpath, $name);
             $imageUrl = $uploadpath.$name;

              $proimage= new ProductImage();
              $proimage->product_id = $productId;
              $proimage->image=$imageUrl;
              $proimage->save();
         }


         return response()->json([
         'status'=>200,
          'message'=>'Product Added Sucessfully',
         ]);
       }
    }

    public function VendorProductEdit($id)
    {
        $userId =Auth::id();
        $product = Product::with('category','subcategory','colors','sizes','productImage')->where('user_id',$userId)->find($id);
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



    public function VendotUpdateProduct(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'slug'=>'required',
            'status'=>'required',
            'category_id'=>'required',
            'image'=>'required',
            'qty'=>'required',
            'selling_price'=>'required',
            'original_price'=>'required',

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
            $product = Product::find($id);
            if($product)
            {

                $product->category_id=$request->input('category_id');
                $product->subcategory_id=$request->input('subcategory_id');
                $product->brand_id=$request->input('brand_id');
                $product->user_id=$request->input('user_id');
                // $product->user_id=Auth::user()->id;
                // $product->slug=$request->input('slug');
                $product->name=$request->input('name');
                $product->slug =Str::slug($request->name);
                $product->short_description=$request->input('short_description');
                $product->long_description=$request->input('long_description');
                $product->selling_price=$request->input('selling_price');
                $product->original_price=$request->input('original_price');
                $product->qty=$request->input('qty');
                $product->status=$request->input('status');
                $product->meta_title=$request->input('meta_title');
                $product->meta_keyword=$request->input('meta_keyword');
                $product->meta_description=$request->input('meta_description');
                $product->product_color=$request->input('product_color');
                $product->product_size=$request->input('product_size');
                $product->tags=$request->input('tags');
                $product->update();
                $product->colors()->attach($request->colors);
                $product->sizes()->attach($request->sizes);


                if($request->hasFile('image'))
                {
                    $path = $product->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() .'.'.$extension;
                    $file->move('uploads/product/', $filename);
                    $product->image = 'uploads/product/'.$filename;
                }

                $productId=$product->id;
                $update_images=ProductImage::where('product_id',$productId)->get();
               $images = $request->file('image');
               if($images){
                    foreach($images as $image)
                      {
                         // image01 upload
                      $name =  time().'-'.$image->getClientOriginalName();
                      $uploadpath = 'public/backend/product/';
                      $image->move($uploadpath, $name);
                      $imageUrl = $uploadpath.$name;

                      $proimage= new ProductImage();
                       $proimage->product_id = $productId;
                       $proimage->image=$imageUrl;
                       $proimage->save();
                      }
                   }else{
                    foreach($update_images as $update_image){
                    $uimage=$update_image->image;
                    $update_image->image  = $uimage;
                     $update_image->save();
                     }
                   }



                $product->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Product Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Product Not Found',
                ]);
            }
        }
    }

    public function VendorDelete($id)
    {
        $userId =Auth::id();
        $product = Product::where('user_id',$userId)->find($id);
        if($product)
        {
            $product->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Product Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Product ID Found',
            ]);
        }
    }





    public function AllCategory()
    {
        $category=Category::with(['subcategory'])->get();
        return response()->json([
            'status'=>200,
            'category'=>$category,
        ]);
    }

    public function AllSubCategory()
    {
        $subcategory=Subcategory::all();
        return response()->json([
            'status'=>200,
            'subcategory'=>$subcategory,
        ]);
    }


    public function AllBrand()
    {
      $brand=Brand::all();
      return response()->json([
          'status'=>200,
          'brand'=>$brand,
      ]);
    }


    public function AllColor()
    {
      $color=Color::all();
      return response()->json([
          'status'=>200,
          'color'=>$color,
      ]);
    }

    public function AllSize()
    {
      $size=Size::all();
      return response()->json([
          'status'=>200,
          'size'=>$size,
      ]);
    }

    public function VendorRequestPending()
    {

        $userId =Auth::id();
         $product=Product::where('user_id',$userId)->where('request','0')->get();
            return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function VendorRequestActive()
    {
        $userId =Auth::id();
         $product=Product::where('user_id',$userId)->where('request','1')->get();
            return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function VendorBalanceRequest()
    {
        $vendor=User::find(Auth::user()->id);
        return response()->json([
            'status'=>200,
            'vendor'=>$vendor
        ]);
    }

    public function VendorRequestSent(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->balance = $request->balance;
        $data->message = $request->message;
        $data->balance_status =0;
        $data->update();

        return response()->json([
            'status'=>200,
            'message'=>'Vendor Balance Added  Successfully Please Wait',
        ]);
    }

}
