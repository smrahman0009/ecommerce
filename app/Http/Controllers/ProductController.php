<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index')->with('products',$products);
    }

    public function details()
    {
        return view('admin.product.details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|image',
            'description'=>'required',
        ]);
            // dd($request->all());
            
        $image = $request->image;
        
        $image_new_name = time() . $image->getClientOriginalName();

      
        $image->move('uploads/products',$image_new_name);
        
        $image_path = public_path("/uploads/products/". $image_new_name);
        $img = Image::make($image_path)->resize(1920, 1080, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($image_path);

        Product::create(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'image' => 'uploads/products/' . $image_new_name,
                'description' => $request->description,
            ]
        );

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product.create')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,Product $product)
    {
        $data = $request->only(['name','price','description']);
        // dd($data);
        if($request->hasFile('image')){
            $image = $request->image;
        
            $image_new_name = time() . $image->getClientOriginalName();
    
          
            $image->move('uploads/products',$image_new_name);
            
            $image_path = public_path("/uploads/products/". $image_new_name);
            $img = Image::make($image_path)->resize(1920, 1080, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($image_path);
            unlink($product->image);
            $product->image = 'uploads/products/' . $image_new_name;
        }

       $product->update($data);

        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        unlink($product->image);

        $product->forceDelete();

        return redirect(route('product.index'));
    }
}
