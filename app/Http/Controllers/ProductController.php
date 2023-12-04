<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;

use App\Models\Categorys;
use App\Models\VariantImage;
use App\Models\VariantProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
        //    $products=Product::all();
             $products = Product::select('products.*','categories.name as category_name')->leftjoin('categories', 'categories.id', '=', 'products.category_id')->orderBy('products.id', 'DESC')->get();
             
           
            // foreach ($products as $product) {
            //     $product->category_name = Category::where('id', $product->category_id)->pluck('')
            // }
            // dd($data);
            
            return Datatables::of($products )
                    ->addIndexColumn()
                    ->addColumn('image', function ($products) { $url=$products->image; 
                        if (str_contains($url, 'https')) {
                        return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />'; 
                           
                        }
                        else{
                        $img_url=url('uploads/product-images'.'/'.$url);
                        // return $img_url;

                        return '<img src="'.$img_url.'" border="0" width="60" class="img-rounded" align="center" />'; 

                        }
                    })
                    ->addColumn('action', function($row){
                        
   
                           $btn = "<a href='product_view/$row->id ' class='edit btn btn-primary btn-sm'>View</a>";
     
                            return $btn;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
       $category=Category::all();
       return view('products.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function show(Product $product)
    public function show($id)  {
        // $user_id = Categorys::find($id);
        //  $category = Categorys::all();
        $variant='empty';
      $product=Product::select('products.*','categories.name as category_name')->leftjoin('categories', 'categories.id', '=', 'products.category_id')->where('products.id',$id)->with('image_detail')->first();
    //   dd($product->image_detail);
      $category = Category::all();
      $variants=VariantProduct::where('variant_products.product_id',$id)->with('variant_image_detail')->get();
      if(count($variants)>0){
        $variant=$variants;
      }
    //    dd($product);
        return view('products.view',compact('product','category','variant'));
    }


 










    public function showdata()
     {
        return view('products.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function addProduct(Request $request){
        // dd($request->'product_var_name_0');
    
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'product_image' => 'required',
            'product_category' => 'required',
            'product_status' => 'required',
            'product_price' => 'required',
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
      
        // $name = $request->file('product_image')->getClientOriginalName();
        // $path = $request->file('product_image')->store('public/images');
        $data=new Product;
        $data->name=$request->product_name;
     
     
        // $data->image=$name;
        $data->short_description=$request->product_description;
        $data->category_id=$request->product_category;
        $data->status=$request->product_status;
        $data->price=$request->product_price;
        $data->points=$request->product_price*10;
        

        $data->save();
        if ($request->hasFile('product_image')) {
            for($i=0;$i<count($request->product_image);$i++){

            
            if($i==0){
                $product=Product::where('id',$data->id)->first();
                $file = $request->file('product_image')[$i];
           
                // $imageName = time() . '.' . $request->image->extension();
                $imageName= time().'.'.$request->product_image[$i]->getClientOriginalName();
                
                $image = $file->move(public_path('uploads/product-images'), $imageName);
                $product->image=$imageName;
                $product->save();
                $datas=new Image;
                $datas->product_id=$data->id;   
                $datas->image=$product->image;
                $datas->save();
            }
               else{
                     $datas=new Image;
                $datas->product_id=$data->id;
                if($request->file('product_image')[$i]){
                $files = $request->file('product_image')[$i];
           
                // $imageName = time() . '.' . $request->image->extension();
                $imageNames= time().'.'.$request->product_image[$i]->getClientOriginalName();
                $image = $files->move(public_path('uploads/product-images'), $imageNames);

                }
                
                $datas->image=$imageNames;
                $datas->save();

               }
           

          
        }
           
        }
        if($request->product_var_name_0!=null){

          

        for($i=0;$i<$request->count_var_name;$i++){
            // $i=(string)$i;
            $var_name="product_var_name_".$i;
            $var_price="product_var_price_".$i;
            $var_image="product_var_image_".$i;


            // dd($var);
            // dd($i);
            // dd($request->$var);
            $var_data=new VariantProduct();
            $var_data->var_name=$request->$var_name;
            $var_data->var_price=$request->$var_price;
            $var_data->product_id=$data->id;

            $var_data->save();
          
        
            if ($request->$var_image) {
                 for($k=0;$k<count($request->$var_image);$k++){
                    $var_img_data=new VariantImage();
                        $var_img_data->variant_id=$var_data->id;
    
                        $var_imageName= time().'.'.$request->$var_image[$k]->getClientOriginalName();
                    
                        $image = $request->$var_image[$k]->move(public_path('uploads/product-images'), $var_imageName);
                        $var_img_data->image=$var_imageName;
                        $var_img_data->save();
                 }
              
            }

        }
    }
        
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);
    }
    public function editProduct(Request $request){
    // dd($request->all());
    
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            
         
            'product_category' => 'required',
            'product_status' => 'required',
            'product_price' => 'required',
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        // dd($request->product_id);
        $data= Product::where('id',$request->product_id)->first();
        $data->name=$request->product_name;
        if ($request->hasFile('main_product_image')) {
        
            $file = $request->file('main_product_image');
           
            // $imageName = time() . '.' . $request->image->extension();
            $imageName= time().'.'.$request->main_product_image->getClientOriginalName();
            
            $image = $file->move(public_path('uploads/product-images'), $imageName);
            $data->image=$imageName;
        }
        
        
       
        $data->long_description=$request->product_description;
        $data->category_id=$request->product_category;
        $data->status=$request->product_status;
        $data->price=$request->product_price;
        $data->update();
        // dd($data);
        // dd($request->all());
        if($request->hasfile('product_image'))
         {
            foreach($request->file('product_image') as $file)
            {
                // dd($file);
                $imaging=new Image();
                // dd($image);
                $imageName= time().'.'.$file->getClientOriginalName();
                $image = $file->move(public_path('uploads/product-images'), $imageName);
                $imaging->image=$imageName;
                $imaging->product_id=$data->id;
                $imaging->save();
            }
         }
        //  $var_product=VariantProduct::where('product_id',$request->product_id)->get();
        //  foreach($var_product as $pro){
        //      $del=VariantProduct::where('id',$pro->id)->first();
        //      if(!empty($del)){
        //          $del->delete();
        //      }
        //      $del_pics=VariantImage::where('variant_id',$pro->id)->first();
        //      if(!empty($del_pics)){
        //          $del_pics->delete();
        //      }
        //  }
        //  dd($request->all());
        $varid=[];
         for($i=0;$i<$request->total_var;$i++){
            // $i=(string)$i;
            $var_id="var_id_".$i;
            $var_name="var_name_".$i;
            $var_price="var_price_".$i;
            $var_image="variant_imgs_".$i;
           

            // dd($var);
            // dd($i);
            // dd($request->$var);
           
            // $var_images=VariantImage::where('variant_id',$var_product->id)
            // $var_product->delete();
            $var_data= VariantProduct::where('id',$request->$var_id)->first();
            $varid[]=$request->$var_id;
            // dd($var_data);
            if(!empty($request->$var_name)){
            $var_data->var_name=$request->$var_name;

            }
            if(!empty($request->$var_price)){

            $var_data->var_price=$request->$var_price;
            }
            // $var_data->product_id=$data->id;

            $var_data->save();
          
        
            if ($request->$var_image) {
                 for($k=0;$k<count($request->$var_image);$k++){
                    $var_img_data=new VariantImage();
                        $var_img_data->variant_id=$var_data->id;
    
                        $var_imageName= time().'.'.$request->$var_image[$k]->getClientOriginalName();
                    
                        $image = $request->$var_image[$k]->move(public_path('uploads/product-images'), $var_imageName);
                        $var_img_data->image=$var_imageName;
                        $var_img_data->save();
                 }
              
            }

        }
        if($request->product_var_name_0!=null){

          

            for($i=0;$i<$request->count_var_name;$i++){
                // $i=(string)$i;
                $var_name="product_var_name_".$i;
                $var_price="product_var_price_".$i;
                $var_image="product_var_image_".$i;
    
    
                // dd($var);
                // dd($i);
                // dd($request->$var);
                $var_data=new VariantProduct();
                $var_data->var_name=$request->$var_name;
                $var_data->var_price=$request->$var_price;
                $var_data->product_id=$data->id;
    
                $var_data->save();
              
            
                if ($request->$var_image) {
                     for($k=0;$k<count($request->$var_image);$k++){
                        $var_img_data=new VariantImage();
                            $var_img_data->variant_id=$var_data->id;
        
                            $var_imageName= time().'.'.$request->$var_image[$k]->getClientOriginalName();
                        
                            $image = $request->$var_image[$k]->move(public_path('uploads/product-images'), $var_imageName);
                            $var_img_data->image=$var_imageName;
                            $var_img_data->save();
                     }
                  
                }
    
            }
        }

// dd($varid);
        
        return response()->json(['status' => 200,'message'=>"data updated successfully!",'data'=>$varid]);
    }


    public function delete_product_images(Request $request){
        $image=Image::where('id',$request->id)->first();
        $image->delete();
        return response()->json(['status' => 200,'message'=>"data deleted successfully!"]);

    }
    public function delete_product(Request $request){
            $product=Product::where('id',$request->id)->first();
            $imgs=Image::where('product_id',$request->id)->get();
            foreach($imgs as $img){
                $images=Image::where('id',$img->id)->first();
                $images->delete();
            }
            $product->delete();
        return response()->json(['status' => 200,'message'=>"product deleted successfully!"]);

    }

    public function delete_var_images(Request $request){
        $image=VariantImage::where('id',$request->id)->first();
        $image->delete();
        return response()->json(['status' => 200,'message'=>"data deleted successfully!"]);
    }

    public function product_var_info(Request $request){
        $var_prod_info=VariantProduct::where('id',$request->id)->with('variant_image_detail')->first();
        return response()->json(['status' => 200,'message'=>"data show successfully!",'data'=>$var_prod_info]);

    }

}
