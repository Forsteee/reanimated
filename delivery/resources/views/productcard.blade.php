<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($products as $product)
        <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$product->name}}</text></svg>
                <div class="card-body">
                    <p class="card-text">{{$product->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <form action="{{ route('basket-add', $product )}}" method="POST">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-sm btn-outline-secondary" role="button">В Корзину</button>
                            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('product_page', $product)}}">Подробнее</a>
                        </div>
                        @csrf
                        </form>
                        <small class="text-muted">{{$product->price}} Р.</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>