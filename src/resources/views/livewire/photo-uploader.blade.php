<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>

<img src="{{ $uploadedPhotos }}" alt="" class="product-img">
<label for="upload" class="product-file__select-button">
    <p class="file-select__text">ファイルを選択</p>
    <input type="file" wire:model="photo" id="upload" accept="image/*" class="product-file__select-hidden">
</label>