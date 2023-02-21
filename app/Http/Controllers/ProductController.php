<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function favorites(){
        $prikol=Auth::user()->productsLiked()->get();
        return view('products.favorites',['products'=>$prikol,'categories'=>Category::all()]);
    }

    public function liked(Product $product){
        $likedProduct=Auth::user()->productsLiked()->where('product_id',$product->id)->first();

        if($likedProduct!= null){
            Auth::user()->productsLiked()->detach($product->id);
        }
        else{
            Auth::user()->productsLiked()->attach($product->id);
        }

        return redirect(route('products.show',$product->id));
    }
    public function productLike(Product $product){
        $likedProduct=Auth::user()->productsLiked()->where('product_id',$product->id)->first();

        if($likedProduct!= null){
            Auth::user()->productsLiked()->detach($product->id);
        }
        else{
            Auth::user()->productsLiked()->attach($product->id);
        }

        return redirect(route('products.favorite',$product->id));
    }
    public function rate(Request $request,Product $product){
        $request->validate([
            'rating'=>'required|min:1|max:5'
        ]);
        $productRated = Auth::user()->productsLiked()->where('product_id',$product->id)->first();
        if($productRated!=null){
            Auth::user()->productsLiked()->updateExistingPivot($product->id,['rating'=>$request->input('rating')]);
        }
        else {
            Auth::user()->productsLiked()->attach($product->id, ['rating' => $request->input('rating')]);
        }
        return back();
    }
    public function unrate(Product $product){
        $productRated=Auth::user()->productsLiked()->where('product_id',$product->id)->first();
        if($productRated != null)
            Auth::user()->productsLiked()->detach($product->id);
        return back();
    }
    public function productsByCategory(Category $category){
        return view('products.index',['products'=>$category->products,'categories'=>Category::all()]);
    }

    public function index(){
        $allProducts = Product::all();

        return view('products.index',['products'=>$allProducts,'categories'=>Category::all()]);
    }
    public function create(){
        $this->authorize('create',Product::class);
        return view('products.create',['categories'=>Category::all()]);
    }
    public function store(Request $req){
        $this->authorize('create',Product::class);
        $validated= $req->validate([
            'title' => 'required|max:255',
            'img'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=50,min_height=50',
            'price' => 'required',
            'type'=>'required',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);
        $fileName=time().$req->file('img')->getClientOriginalName();
        $image_path=$req->file('img')->storeAs('products',$fileName,'public');
        $validated['img']= '/storage/'.$image_path;

        Auth::user()->products()->create($validated);
        return redirect(route('products.index'))->with('message','Sucsessfully');
    }
    public function show(Product $product){
        $fav=0;
        if(Auth::check())
        {
            $favorite_product = Auth::user()->productsLiked()->where('product_id',$product->id)->first();
            if($favorite_product!=null)
            {
                $fav=$favorite_product->product_id;
            }
        }

        $myRating=0;
        $productRating=Auth::user()->productsRated()->where('product_id',$product->id)->first();
        if($productRating != null)
            $myRating=$productRating->pivot->rating;
        $avgRating=0;
        $sum=0;
        $ratedUsers=$product->usersRated()->get();
        foreach ($ratedUsers as $rateUser){
            $sum+=$rateUser->pivot->rating;
        } if(count($ratedUsers)>0)
            $avgRating=$sum/count($ratedUsers);
        return view('products.show',['products'=>$product,'fav'=>$fav,'myRating'=>$myRating,'avgRating'=>$avgRating,'comment'=>Comment::all(),'categories'=>Category::all()]);
    }


    public function edit(Product $product)
    {
        return view('products.edit',['products'=>$product,'categories'=>Category::all()]);
    }


    public function update(Request $request,Product $product)
    {
        $product->update([
            'title'=>$request->input('title'),
            'img'=>$request->input('img'),
            'type'=>$request->input('type'),
            'price'=>$request->input('price'),
            'category_id'=>$request->category_id,
        ]);
        return redirect(route('products.index'))->with('message','Products Updated Sucsessfully');
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete',$product);
        $product->delete();
        return redirect(route('products.index'))->with('message','Products deleted sucsessfully');
    }
}
