<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SuperSubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportUser implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if(!empty($row['name'])){

        $point=0;
        $categoryy=Category::where('name',$row['categories'])->first();
        if(empty($categoryy)){
            $users_cat = new Category();
            $users_cat->name =$row['categories'];
            $users_cat->status=1;
            $users_cat->save();

        }
        if(!empty($row['sub_cat'])){
        $subcategoryy=Subcategory::where('sub_category',$row['sub_cat'])->first();
        if(empty($subcategoryy)){
            $users_sub_cat = new Subcategory() ;
            $users_sub_cat->sub_category =$row['sub_cat'];
            $users_sub_cat->status=1;
        $categoryy=Category::where('name',$row['categories'])->first();
           $users_sub_cat->category_id =$categoryy->id;

            $users_sub_cat->save();

        }
    }
        if(!empty($row['sub_sub_cat'])){  
        $sub_subcategoryy=SuperSubCategory::where('name',$row['sub_sub_cat'])->first();
        if(empty($sub_subcategoryy)){
            $users_sub_sub_cat = new SuperSubCategory() ;
            $users_sub_sub_cat->name =$row['sub_sub_cat'];
            if(!empty($row['sub_cat'])){
        $subcategoryy=Subcategory::where('sub_category',$row['sub_cat'])->first();
            
            $users_sub_sub_cat->subcategory_id = $subcategoryy->id;
            }
            if(!empty($row['categories'])){
          $categoryy=Category::where('name',$row['categories'])->first();
            $users_sub_sub_cat->category_id = $categoryy->id;
            }
            $users_sub_sub_cat->status=1;
            $users_sub_sub_cat->save();

        }
    }

        if(!empty($row['categories'])){
            $category=Category::where('name',$row['categories'])->first();
            
        }

        if(!empty($row['sub_cat'])){
            $subcategory=Subcategory::where('sub_category',$row['sub_cat'])->first();
        
            }

        if(!empty($row['sub_sub_cat'])){
            $sub_subcategory=SuperSubCategory::where('name',$row['sub_sub_cat'])->first();
        }

          

        $product_save = new Product([

            'name' => $row['name'],
            'type' => $row['type'],
            'category_id'=>!empty($category)==1?$category->id:null,
            'subcategory_id'=>!empty($subcategory)==1?$subcategory->id:null,
            'sub_subcategory_id'=>!empty($sub_subcategory)==1?$sub_subcategory->id:null,
            'sku' => $row['sku'],
            'published' => $row['published'],
            'featured_product' => $row['is_featured'],
            'visibility' => $row['visibility_in_catalog'],
            'brand' => $row['brands'],
            'short_description' => $row['short_description'],
            'price' => $row['regular_price'],
            'points' => ($row['regular_price']*10),
            'long_description' => $row['description'],
            'tags' => $row['tags'],
            'vat' =>($row['tax_class']*100).".00%"

        ]);
    
     
        $product_save->save();
    
        // return new Product([
        //     'name' => $row[3],
        //    'type' => $row[1],
        //    'sku' => $row[2],
        //    'published' => $row[4],
        //    'featured_product' => $row[5],
        //    'visibility' => $row[6],     
        //    'promotional_price' => $row[8],
        //    'category' => $row[26],
        //    'brand' => $row[28],
        //    'image' => $row[30],
        //    'short_description' => $row[7],
        //    'price'=>$row[9],
        //    'long_description'=>$row[10],
        //    'tags'=>$row[27],




        // ])
        //     $data=new Product;
        //     $data->name= isset($row[3])?$row[3]:'';
        //     $data->type= isset($row[1])?$row[1]:'';
        //     $data->sku = isset($row[2])?$row[2]:' ';
        //     $data-> published =isset($row[4])?$row[4]:'';
        //     $data->featured_product =isset($row[5])?$row[5]:'';
        //     $data->visibility = isset($row[6])?$row[6]:'';
        //     // $data-> promotional_price = $row[8];
        //     // $data->category = $row[26];
        
        //     $data->brand = isset($row[30])?$row[30]:'';
        //     // $data->image = $row[30];

        //     $data->short_description = isset($row[7])?$row[7]:'';
        //     $data->price=isset($row[25])?$row[25]:'';
        //     if(!is_string($row[25])){
        //     if(is_int($row[25])){
        //       $point= $data->price*10;
        //     }
        //     elseif(is_float($row[25])){
                
        //         $point= $row['Reguler']*10.0;
               
                
        //     }
        //     else{
        //         $point=  $data->price*10;

        //     }
        //     $data-> points=$point;
           
        //          }
               
      
        //     // $data->points=(is_string($row[25]))?'':$row[25]*10;
        //     $data-> long_description=isset($row[8])?$row[8]:'';
        //     $data-> tags=isset($row[29])?$row[29]:'';
        //     $data->vat=isset($row[33])?$row[33]:'';
        //     if(isset($row[26])){
        //         $category=Category::where('name',$row[26])->first();
        //         if(!empty($category)){
        //         $id=$category->id;
        //         $data->category_id=$id;
        //         }
        //     }
        //     if(isset($row[27])){
        //         $subcategory=Subcategory::where('sub_category',$row[27])->first();
        //         if(!empty($subcategory)){
        //         $id=$subcategory->id;
        //         $data->subcategory_id=$id;
        //         }
        //     }
        //     if(isset($row[28])){
                
        //         $sub_subcategory=SuperSubCategory::where('name',$row[27])->first();
        //         if(!empty($sub_subcategory)){

        //         $id=$sub_subcategory->id;
        //         $data->sub_subcategory_id=$id;
        //     }
        // }
        //     // $data->category= isset( $row[26])?explode(',', $row[26]):null;
        //     $data->save();
            
            
            $img_Array = isset( $row['images'])?explode(',', $row['images']):null;
            $count=1;
            if($img_Array!=null){
            foreach($img_Array as $arr){
                if($count==1){
                    $product=Product::find($product_save->id);
                    $product->image=$arr;
                    $product->save();
                }

                $datas=new Image;
                $datas->product_id=$product_save->id;
                $datas->image=$arr;
                $datas->save();
                $count++;
            }
        }
      //  }
    //         $cat_Array = isset( $row[26])?explode(',', $row[26]):null;
    //         if($cat_Array!=null){
    //         foreach($cat_Array as $arrr){
    //             $datas_cat=new Category;
    //             $datas_cat->product_id=$data->id;
    //             $datas_cat->name=$arrr;
    //             $datas_cat->save();
    //         }

    //     }
       
    //     $sub_cat_Array = isset( $row[27])?explode(',', $row[27]):null;
    //         if($sub_cat_Array!=null){
    //         foreach($sub_cat_Array as $arrr){
    //             $datas_sub_cat=new Subcategory();
    //             $datas_sub_cat->category_id=$datas_cat->id;
    //             $datas_sub_cat->status=1;
    //             $datas_sub_cat->sub_category=$arrr;
    //             $datas_sub_cat->save();
    //         }

    //     }
    //     $super_sub_cat_Array = isset( $row[28])?explode(',', $row[28]):null;
    //     if($super_sub_cat_Array!=null){
    //     foreach($super_sub_cat_Array as $arrr){
    //         $datas_super_sub_cat=new SuperSubCategory();
    //         $datas_super_sub_cat->category_id=$datas_cat->id;

    //         // $datas_cat->category_id=$data->id;
    //         if(!empty($datas_sub_cat)){
    //         $datas_super_sub_cat->subcategory_id=$datas_sub_cat->id;
    //         }
    //         $datas_super_sub_cat->name=$arrr;
    //         $datas_super_sub_cat->save();
    //     }

    // }
        

            // $datas->image=$row[30];
           

        
        
    }
       
}
}



