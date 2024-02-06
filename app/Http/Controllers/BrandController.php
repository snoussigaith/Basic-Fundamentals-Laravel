<?php

namespace App\Http\Controllers;
use App\Models\Brand;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand() {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }
    
}
