<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DetailRequest;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $sort = $request->get('sort');
        if (isset($sort)){
            $products = product::orderBy('price', $sort)->paginate(6);
        }else{
            $products = product::paginate(6);
        }

        return view('products', compact('products', 'sort'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $search_results = product::Search($keyword)->paginate(6);

        $sort = $request->get('sort');
        if (isset($sort)){
            $products = product::orderBy('price', $sort)->paginate(6);
        }else{
            $products = product::paginate(6);
        }

        return view('products', compact('search_results', 'keyword', 'sort', 'products'));
    }

    public function show($productId)
    {
        $product = product::find($productId);
        $seasonName = $product->seasons;
        $season = $seasonName->pluck('name');

        return view('detail', compact('product', 'season'));
    }

    public function edit(DetailRequest $request)
    {
        if ($request->file('imgpath') != null) {
        $productId = $request->input('productId');
        $product = Product::find($productId);
        $seasonName = $product->seasons;
        $season = $seasonName->pluck('name');

        $imageFile = $request->file('imgpath');
        $basePath = 'fruits-img/fruits-img/';
        $imageName = $imageFile->getClientOriginalName();
        $path = Storage::putFileAs('public/' . $basePath, $imageFile, $imageName);
        $product['image'] = $basePath . $imageName;
        return view('detail', compact('product', 'season'));
    }
        $id = $request->only('id');
        $product_edit = $request->only(['name', 'price', 'image', 'description']);
        $seasons = $request->only(['season']);

        $product = Product::find($id)->first();

        $product->update($product_edit);
        foreach($seasons as $season) {
            $product->seasons()->sync($season);
        }
        return redirect('products');
    }

    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();

        return redirect('/products');
    }

    public function register()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $imageFile = $request->file('image');
        $basePath = 'fruits-img/fruits-img';
        $imageName = $imageFile->getClientOriginalName();
        $path = Storage::putFileAs('public/' . $basePath, $imageFile, $imageName);
        $viewPath = $basePath . '/' . $imageName;

        $registerProducts = $request->only(['name', 'price', 'description']);

        $register = Product::create([
            'name' => $registerProducts['name'],
            'price' => $registerProducts['price'],
            'image' => $viewPath,
            'description' => $registerProducts['description']
        ]);

        $seasons = $request->only('season');
        foreach($seasons as $season) {
            $register->seasons()->attach($season);
        }

        return redirect('/products');
    }
}
