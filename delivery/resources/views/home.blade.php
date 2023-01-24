@extends('master')
@section('content')
<div class="container">
    <div class="album py-5 bg-light">
        @include('productcard',compact('products'))
    </div>
</div>
@endsection