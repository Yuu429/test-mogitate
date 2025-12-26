<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailFoem extends Component
{
    public $imgpath;

    protected $rules = [
        'imgpath' => 'file|mimes:jpeg,png'
    ];

    public function update(DetailRequest $request)
    {
        $productId = $request->input('productId');

        $imageFile = $request->file('imgpath');

        $basePath = 'fruits-img/fruits-img/';

        $imageName = $imageFile->getClientOriginalName();

        $path = Storage::putFileAs('public/' . $basePath, $imageFile, $imageName);

        $update = Product::find($productId)->update(['image' => $basePath . $imageName]);

        return redirect()->route('product.show', ['productId' => $productId]);
    }

    public function render()
    {
        return view('livewire.detail-foem');
    }
}
