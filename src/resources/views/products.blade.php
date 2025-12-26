<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOGITATE</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
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
        @empty($keyword)
        <div class="products__list">
            <div class="products__heading">
                商品一覧
            </div>
            <a href="{{ route('product.register') }}" class="products__register">
                + 商品の追加
            </a>
        </div>
        @else
        <div class="products__list">
            <div class="products__heading">
                “{{$keyword}}”の商品一覧
            </div>
        </div>
        @endempty
        <div class="products__inner">
            <div class="products__function">
                <form class="products__search" action="/products/search" method="get">
                    @csrf
                    <input type="text" name="keyword" value="{{ request()->input('keyword') }}" class="products__search--input" placeholder="商品名で検索">
                    <button class="products__search--button">
                        検索
                    </button>
                </form>
                <div class="sort">
                    <div class="sort__view">
                        価格順で表示
                    </div>
                    <div class="sort__function">
                        <form action="/products" method="get" class="products__sort">
                            @csrf
                            <select name="sort" onchange="submit(this.form)" class="products__sort-select">
                                <option value="" disabled selected>価格で並べ替え</option>
                                <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                                <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>低い順に表示</option>
                            </select>
                        </form>
                        <div class="sort-view">
                            @empty($sort)
                            @else
                            @if($sort === 'desc')
                            <div class="inner__sort-view">
                                <p class="sort-text">高い順に表示</p>
                                <button class="sort-view-back" type="button" onClick="location.href='http://localhost/products'">&times;</button>
                            </div>
                            @else
                            <div class="inner__sort-view">
                                <p class="sort-text">低い順に表示</p>
                                <button class="sort-view-back" type="button" onClick="location.href='http://localhost/products'">&times;</button>
                            </div>
                            @endif
                            @endempty
                        </div>
                    </div>
                </div>
                <div class="border-line"></div>
            </div>
            <div class="cards">
            @empty($keyword)
            @foreach ($products as $product)
                <div class="product-card">
                    <a href="products/{{ $product->id }}">
                        <div class="card__image">
                            <img class="kiwi-image" src="{{ asset('storage/'. $product->image) }}" alt="">
                        </div>
                        <div class="card__text">
                            <p class="product__text">
                                {{ $product->name }}
                            </p>
                            <p class="product__price">{{ $product->price }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
            @else
            @foreach ($search_results as $result)
                <div class="product-card">
                    <a href="">
                        <div class="card__image">
                            <img src="{{ asset('storage/'. $result->image) }}" alt="" class="kiwi-image">
                        </div>
                        <div class="card__text">
                            <p class="product__text">
                                {{ $result->name }}
                            </p>
                            <p class="product__price">
                                {{ $result->price }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
            @endempty
            </div>
        </div>
        @empty($keyword)
        <div class="paginate">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @else
        @endempty
    </main>
</body>
</html>