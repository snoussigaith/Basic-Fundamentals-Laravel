<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand() {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }
    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg.jpeg,png',

            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            
        ]);
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

    Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image'=> $last_img,
        'created_at'=> Carbon::now()
    ]);
   
    return Redirect()->back()->with('success','Brand Inserted Successfull');

    }
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));

    }
    public function Update(Request $request,$id){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',

            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);
    
    
    
            unlink($old_image);
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image'=> $last_img,
            'created_at'=> Carbon::now()
        ]);
       
        return Redirect()->back()->with('success','Brand Updated Successfull');

        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                
                'created_at'=> Carbon::now()
            ]);
           
            return Redirect()->back()->with('success','Brand Updated Successfull');

        }
       
    }
}
