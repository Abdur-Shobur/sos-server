<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
        public function ProductIndex()
    {
        $product=Product::with('category','subcategory')->get();
        return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function ProductStore(Request $request)
    {

           $validator=Validator::make($request->all(),[

               'name' => 'required|unique:products|max:255',
               'status'=>'required',
               'category_id'=>'required',
               'qty'=>'required',
               'selling_price'=>'required',
               'original_price'=>'required',
            //    'image' => 'required|mimes:jpeg,png,jpg,gif',
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
            // $product->user_id=Auth::user()->id;;
            $product->brand_id=$request->input('brand_id');
            $product->user_id=$request->input('user_id');
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
            $product->commision_type=$request->input('commision_type');


            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .'.'.$extension;
                $file->move('uploads/product/', $filename);
                $product->image = 'uploads/product/'.$filename;
            }
            $product->save();

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




            // $name =  time().'-'.$image->getClientOriginalName();
            // $uploadpath = 'uploads/product/';
            // $image->move($uploadpath, $name);
            // $imageUrl = $uploadpath.$name;

            //  $proimage= new ProductImage();
            //  $proimage->product_id = $productId;
            //  $proimage->image=$imageUrl;
            //  $proimage->save();



            // $admin->product_id=$product_id;
            // $admin->save();






            return response()->json([
            'status'=>200,
             'message'=>'Product Added Sucessfully',
            ]);
          }
    }

    public function ProductEdit($id)
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

    public function destroy($id)
    {
        $product = Product::find($id);

        // $image_path = app_path("uploads/product/{$product->image}");

        // if (File::exists($image_path)) {
        //     unlink($image_path);
        // }
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

    public function UpdateProduct(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
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
                $product->slug=$request->input('slug');
                $product->name=$request->input('name');
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
                $product->commision_type=$request->input('commision_type');



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

       public function AllCategory()
    {
        $category=Category::with(['subcategory'])->get();
        return response()->json([
            'status'=>200,
            'category'=>$category,
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



}
