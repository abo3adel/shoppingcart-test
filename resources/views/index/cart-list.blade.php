<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link" :class="{active: h.d.activeInstance === 'default'}"
            v-on:click.prevent="h.d.changeInstance('default')" href="#">Default list</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" :class="{active: h.d.activeInstance === 'wishlist'}"
            v-on:click.prevent="h.d.changeInstance('wishlist')" href="#">Wish list</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" :class="{active: h.d.activeInstance === 'compare'}"
            v-on:click.prevent="h.d.changeInstance('compare')" href="#">Compare list</a>
    </li>
</ul>
<div class="text-center mt-4" v-show="h.d.loading">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status">
        <div class="spinner-grow text-danger" style="width: 2rem; height: 2rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<div class="row my-4" v-for="item in h.d.activeList" :key="item.id" :id="item.instance + item.id">
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
                <strong class="col-6 text-right text-secondary" v-show="h.d.activeInstance === 'default'">
                    QTY: @{{ item.qty }}
                </strong>
            </p>
            <div class="row">
                <div class="col-6 text-left">
                    <button class="btn btn-success btn-sm" v-show="h.d.activeInstance === 'default'"
                        v-on:click.prevent="h.d.update(item.id, 'add', item.instance)"
                        :disabled="item.qty >= item.buyable.qty">
                        <x-btn-loader :vue="true" id="'add' + item.id"></x-btn-loader>
                        &plus;
                    </button>
                    <button class="btn btn-warning btn-sm" v-show="h.d.activeInstance === 'default'"
                        v-on:click.prevent="h.d.update(item.id, 'sub', item.instance)" :disabled="item.qty <= 1">
                        <x-btn-loader :vue="true" id="'sub' + item.id"></x-btn-loader>
                        &minus;
                    </button>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-sm btn-danger" v-on:click.prevent="h.d.destroy(item.id, item.instance)">
                        <x-btn-loader :vue="true" id="'del' + item.id"></x-btn-loader>
                        &times; DELETE
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
