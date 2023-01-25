@extends('master')
@section('content')
<div class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">{{ $product -> name }}</h2>
        <p class="lead">{{$product -> description}}</p>
      </div>
        <div class="bg-body shadow-sm mx-auto" style="width: 80%; border-radius: 21px 21px 0 0;">
            {{$product -> price}} Р.
            <button type="button" class="btn btn-sm btn-outline-secondary">В Корзину</button>
        </div>
    </div>
@endsection