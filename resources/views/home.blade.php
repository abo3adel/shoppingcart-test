@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-3">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" :class="{active: h.d.activeInstance === 'default'}"
                        v-on:click.prevent="h.d.changeInstance('default')" href="#">Default list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{active: h.d.activeInstance === 'wish'}"
                        v-on:click.prevent="h.d.changeInstance('wish')" href="#">Wish list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{active: h.d.activeInstance === 'cmp'}"
                        v-on:click.prevent="h.d.changeInstance('cmp')" href="#">Compare list</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-9">
            <div class="row">
                @foreach($products as $p)
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <img src="{{ asset('1.jpg') }}" class="card-img-top" height="220"
                                alt="image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $p->title }}
                                </h5>
                                <p class="card-text">
                                    <strong class="text-primary">
                                        ${{ $p->getSubPrice() }}
                                    </strong>
                                    <br />
                                    <strong class="text-muted">
                                        <del>
                                            ${{ $p->price }}
                                        </del>
                                    </strong>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="btn-group" role="group" aria-label="Basic lite">
                                    <button type="button" class="btn btn-success" title="add to wishlist"
                                        v-on:click.prevent="h.d.addToCart({{ $p->id }}, 'wishlist')">
                                        <x-btn-loader id="{{ $p->id }}wishlist"></x-btn-loader>
                                        <span class="wish">&hearts;</span>
                                    </button>
                                    <button type="button" class="btn btn-primary" title="add to cart"
                                        v-on:click.prevent="h.d.addToCart({{ $p->id }}, 'default')">
                                        <x-btn-loader id="{{ $p->id }}default"></x-btn-loader>
                                        &plus; Cart
                                    </button>
                                    <button type="button" class="btn btn-info" title="add to compare"
                                        v-on:click.prevent="h.d.addToCart({{ $p->id }}, 'compare')">
                                        <x-btn-loader id="{{ $p->id }}compare"></x-btn-loader>
                                        &sum;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
