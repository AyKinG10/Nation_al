<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories= Category::all();
        return view('adm.categories.index',['categories'=>$categories]);
    }
    public function create(){
        return view('adm.categories.create',['categories'=>Category::all()]);
    }
    public function store(Request $request){
        $validated = $request->validate([
           'name'=>'required|max:50',
           'code'=>'required|max:15',
        ]);
        Category::create($validated);
        return redirect()->route('adm.categories.index',['categories'=>Category::all()])->with('Successfully','Added a new category');
    }
    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('adm.categories.index');
    }
}
