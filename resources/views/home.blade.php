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
            <div class="row my-4" v-for="item in h.d.activeList" :key="item.id">
                <div class="media col-12">
                    <img src="/1.jpg" class="mr-3 img-thumbnail" alt="product-image" width="85">
                    <div class="media-body">
                        <h5 class="mt-0">
                            @{{ item.buyable.title }}
                        </h5>
                        <p class="row">
                            <strong class="text-primary col-6 text-left">
                                $@{{ h.d.formatNum(item.sub_total) }}
                            </strong>
                            <strong class="col-6 text-right text-danger">
                                QTY: @{{ item.qty }}
                            </strong>
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-success btn-sm">
                                    &plus;
                                </button>
                                <button class="btn btn-warning btn-sm">
                                    &minus;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 mt-3">
            <div class="row">
                @foreach($products as $p)
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <img src="{{ asset('1.jpg') }}" class="card-img-top" height="200"
                                alt="image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $p->title }}
                                </h5>
                                <p class="card-text">
                                    <strong class="text-primary">
                                        ${{ \number_format($p->getSubPrice(), 2) }}
                                    </strong>
                                    <br />
                                    <strong class="text-muted">
                                        <del>
                                            ${{ \number_format($p->price, 2) }}
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
