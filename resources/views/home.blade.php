@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4">
            @include('index.cart-list')
        </div>
        <div class="col-12 col-md-8 mt-3">
            @include('index.products')
        </div>
    </div>
</div>
@endsection
