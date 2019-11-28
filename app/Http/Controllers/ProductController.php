<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

  public function showAllProducts()
  {
    return response()->json(Product::all());
  }

  public function showOneProduct($id)
  {
    return response()->json(Product::find($id));
  }
}
