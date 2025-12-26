<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOGITATE</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    @livewireStyles
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo">
                mogitate
            </a>
        </div>
    </header>
    <main>
        <div class="view__inner">
            <div class="product-fruit">
                <p class="list-product"><span>商品一覧</span> > {{ $product->name }}</p>
            </div>
            <form action="{{ route('product.patch') }}" method="post" enctype="multipart/form-data" class="change-form">
            @method('patch')
            @csrf
                <div class="product__wrap">
                    <div class="image__container">
                        <img class="product-img" src="{{ asset('storage/'. $product->image) }}" alt="">
                        <label for="upload" class="product-file__select-button">
                            <p class="file-select__text">ファイルを選択</p>
                            <input type="file" onchange="submit(this.form)" name="imgpath" id="upload" accept="image/*" class="product-file__select-hidden">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                        </label>
                    </div>
                    <div class="product__detail">
                        <div class="product-name">
                            <p class="product__text">
                                商品名
                            </p>
                            <input type="type" name="name" value="{{ $product->name }}" class="product__input">
                        </div>
                        <div class="form__error">
                            @error('name')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="product-price">
                            <p class="product__text">
                                値段
                            </p>
                            <input type="text" name="price" value="{{ $product->price }}" class="product__input">
                        </div>
                        <div class="form__error price">
                            @error('price')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="product-season">
                            <p class="product__text">
                                季節
                            </p>
                            <ul>
                                <li>
                                    <label for="spring">
                                    <input type="checkbox" name="season[]" id="spring" value="1" class="product-season__input" {{ $season->contains('春') ? 'checked' : '' }}>
                                    <p class="check-mark">✓</p></label>
                                    <span class="season-ward">春</span>
                                </li>
                                <li>
                                    <label for="summer">
                                    <input type="checkbox" name="season[]" id="summer" value="2" class="product-season__input" {{ $season->contains('夏') ? 'checked' : '' }}>
                                    <p class="check-mark">✓</p></label>
                                    <span class="season-ward">夏</span>
                                </li>
                                <li>
                                    <label for="fall">
                                    <input type="checkbox" name="season[]" id="fall" value="3" class="product-season__input" {{ $season->contains('秋') ? 'checked' : '' }}>
                                    <p class="check-mark">✓</p></label>
                                    <span class="season-ward">秋</span>
                                </li>
                                <li>
                                    <label for="winter">
                                    <input type="checkbox" name="season[]" id="winter" value="4" class="product-season__input" {{ $season->contains('冬') ? 'checked' : '' }}>
                                    <p class="check-mark">✓</p></label>
                                    <span class="season-ward">冬</span>
                                </li>
                            </ul>
                        </div>
                        <div class="form__error">
                            @error('season')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="product-explanation">
                    <div class="explanation__heading">
                        <p class="explanation__heading-text">商品説明</p>
                    </div>
                    <div class="explanation">
                        <textarea class="explanation-textarea" name="description">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="form__error">
                    @error('description')
                        <li>{{ $message }}</li>
                    @enderror
                </div>
                <div class="button__wrap">
                    <button class="back__button" type="button" onclick="history.back()">戻る</button>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button class="change__button" type="submit">変更を保存</button>
                </div>
            </form>
            <form class="delete__form" method="post" action="{{ route('product.destroy', ['id'=>$product->id]) }}">
                @csrf
                @method('delete')
                <button class="delete__button" type="submit"><img src="{{ asset('storage/trash-img/trash.png') }}" alt="" class="trash__img"></button>
            </form>
        </div>
    </main>
    @livewireStyles
</body>
</html>