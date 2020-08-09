<div class="row">
    @foreach($products as $p)
        <div class="col-6 col-sm-4 mb-3 p-1">
            <div class="card p-0 m-0">
                <img src="{{ asset('1.jpg') }}" class="card-img-top" height="150" alt="image">
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