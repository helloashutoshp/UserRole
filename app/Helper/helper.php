<?php

use App\Models\Cate;
use App\Models\ProductImg;

function getCategory()
{
    $category = Cate::orderby('name', 'ASC')->with('subCategory')->where('status',1)->where('showHome', 'Yes')->get();
    return $category;
}

function getProductImg($product_id){
    $image = ProductImg::where('product_id',$product_id)->first();
    return $image;
}