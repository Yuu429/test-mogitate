<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOGITATE</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
        <div class="register__container">
            <div class="register__header">
                商品登録
            </div>
            <div class="register-form__container">
                <form action="{{ route('register.create') }}" method="post" enctype="multipart/form-data" class="register__form">
                    @csrf
                    <div class="input-column">
                        <div class="wrap">
                            <div class="product-header">
                                商品名
                            </div>
                            <div class="require">
                                必須
                            </div>
                        </div>
                        <div class="form__input">
                            <input type="text" name="name" value="{{ $products['name'] ?? ''}}" class="form__input-text" placeholder="商品名を入力" >
                        </div>
                        <div class="form__error">
                            @error('name')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="input-column">
                        <div class="wrap">
                            <div class="product-header">
                                値段
                            </div>
                            <div class="require">
                                必須
                            </div>
                        </div>
                        <div class="form__input">
                            <input type="text" name="price" value="{{ $products['price'] ?? '' }}" class="form__input-text" placeholder="値段を入力">
                        </div>
                        <div class="form__error">
                            @error('price')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="input-column">
                        <div class="wrap">
                            <div class="product-header">
                                商品画像
                            </div>
                            <div class="require">
                                必須
                            </div>
                        </div>
                        <img src="{{ asset('storage/'. ($viewPath ?? '')) }}" alt="" id="image-preview" class="product-image">
                        <label for="image-select" class="product-file__select-button">
                            <p class="file-select__text">ファイルを選択</p>
                            <input type="file" name="image" value="" id="image-select" onchange="previewImage(event)" accept="image/*" class="product-file__select-hidden">
                        </label>
                        <div class="form__error">
                            @error('image')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="input-column">
                        <div class="wrap">
                            <div class="product-header">
                                季節
                            </div>
                            <div class="require">
                                必須
                            </div>
                        </div>
                        <ul>
                            <li>
                                <label for="spring">
                                <input type="checkbox" name="season[]" id="spring" value="1" class="product-season__input" {{ isset($seasons -> {1}) ? 'checked' : '' }}>
                                <p class="check-mark">✓</p></label>
                                <span class="season-ward">春</span>
                            </li>
                            <li>
                                <label for="summer">
                                <input type="checkbox" name="season[]" id="summer" value="2" class="product-season__input" {{ isset($seasons -> {2}) ? 'checked' : '' }}>
                                <p class="check-mark">✓</p></label>
                                <span class="season-ward">夏</span>
                            </li>
                            <li>
                                <label for="fall">
                                <input type="checkbox" name="season[]" id="fall" value="3" class="product-season__input" {{ isset($seasons -> {3}) ? 'checked' : '' }}>
                                <p class="check-mark">✓</p></label>
                                <span class="season-ward">秋</span>
                            </li>
                            <li>
                                <label for="winter">
                                <input type="checkbox" name="season[]" id="winter" value="4" class="product-season__input" {{ isset($seasons -> {4}) ? 'checked' : '' }}>
                                <p class="check-mark">✓</p></label>
                                <span class="season-ward">冬</span>
                            </li>
                        </ul>
                        <div class="form__error">
                            @error('season')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="input-column">
                        <div class="wrap">
                            <div class="product-header">
                                商品説明
                            </div>
                            <div class="require">
                                必須
                            </div>
                        </div>
                        <div class="explanation">
                            <textarea class="explanation-textarea" name="description" placeholder="商品の説明を入力">{{ $products['description'] ?? '' }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('description')
                                <li>{{ $message }}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="button__wrap">
                        <button class="back__button" type="button" onclick="history.back()">戻る</button>
                        <button class="change__button" type="submit">変更を保存</button>
                    </div>
                </form>
                <form action="" method="post" id="imageForm">
                    <input type="hidden" name="image" value="{{ $viewPath ?? '' }}">
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    function previewImage(event) {
        const file= event.target.files[0];
        const preview = document.getElementById('image-preview');

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
</html>