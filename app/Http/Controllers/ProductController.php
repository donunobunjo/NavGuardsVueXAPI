<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return Response::json(['products'=>$products]);
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
        $validator = Validator::make($request->all(),[
            'item'=>'required',
            'quantity'=>'required',
            'price'=>'required'

        ]);
        if ($validator->fails()){
            Response::json(['message'=>'OOppppps']);
        }
        $user= Auth::user();
        //$lala=100;
        $product = Product::create([
            'item'=>$request->item,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'user_id'=>$user->id

        ]);
        Return Response::json(['product'=>$product]);
        //Return Response::json(['msg'=>'lalala']);
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
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return Response::json(['message'=>'Product updated succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //$status = $product->delete();
        $product=Product::find($id);
        $status = $product->delete();
        if ($status){
            return Response::json(['message'=>'Product deleted successfully']);
        }
    }
}
