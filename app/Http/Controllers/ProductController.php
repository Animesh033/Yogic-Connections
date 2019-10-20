<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(10);
        $categories = Category::orderBy('name')->get();
        return view('product.index', compact('products', 'categories'));
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('products')
                        ->withErrors($validator)
                        ->withInput();
        }
        $Product = Product::create($data);
        if ($Product) {
            return redirect('products')->with('success', 'Product is added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search(Request $request)
    {
        $term = $request->term; // only 'term' works, dont use input name here i.e $request->name_of_input;
        $searchitems = TodoList::where('item', 'LIKE', '%'.$term.'%')->get();
// dd($items);
        if (count($searchitems) == 0) {
            $items[] = 'No Item Found';
            return $items; 
        }else{
            foreach ($searchitems as $value) {
                $items[] = $value->item;
            }
            // dd($items);
            return $items;
        }
    }
}
