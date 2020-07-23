<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\Categorie;

class categoryController extends Controller
{
    public function category(){
        return view('category.category');
    }

    public function addcategory(Request $request){
        $this->validate($request,[
            'category'=>'required'
        ]);
        $categories = new Categorie();
        $categories->category=$request->input('category');
        $categories->save();
        return redirect('/category')->with('response','Category Added Sucessfully');

    }
}
