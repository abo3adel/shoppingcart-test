import { Vue } from "vue-property-decorator";
import Axios from "axios";
import { Component, Prop } from "vue-property-decorator";
import Super from "./super";
import CartItemInterface from "../interfaces/cart-item";

export interface HomeData {
    cart: CartItemInterface[];
    wish: CartItemInterface[];
    cmp: CartItemInterface[];
    activeInstance: string;
    activeList: CartItemInterface[];
}

@Component
export default class Home extends Super {
    public d: HomeData = {
        // all your compnent data will be present in here
        cart: [],
        wish: [],
        cmp: [],
        activeInstance: "default",
        activeList: []
    };

    public formatNum(num: number): string {
        return new Intl.NumberFormat("en-EG").format(num);
    }

    public addToCart(id: number, instance: string): void {
        const loader = this.showLoader(`${id}${instance}`);

        Axios.post(`/cart/${id}`, { instance }).then(res => {
            if (!res) {
                loader.add("d-none");
                this.errorMes();
                return;
            }
            if (res.status === 204) {
                loader.add("d-none");
                this.errorMes("This product is already exists in cart");
                return;
            }

            if (instance === "wishlist") {
                this.d.wish.push(res.data);
            } else if (instance === "compare") {
                this.d.cmp.push(res.data);
            } else {
                this.d.cart.push(res.data);
            }
            this.successMes();
            loader.add("d-none");
        });
    }

    public update(id: number, type: string, instance: string): void {
        const loader = this.showLoader(type + id);

        Axios.patch(`cart/${id}`, { type, instance }).then(res => {
            if (!res || res.status !== 204) {
                this.errorMes();
                return;
            }

            // alter item
            this.d.cart.map(x => {
                if (x.id === id) {
                    x.qty =
                        type === "sub" ? x.qty - 1 : x.qty + 1;
                }
                return x;
            });

            this.successMes();
            loader.add("d-none");
        });
    }

    public loadAllCartItems(): void {
        // TODO show loader for all items
        Axios.get("/cart").then(res => {
            this.d.cart = res.data.all;
            this.d.wish = res.data.wish;
            this.d.cmp = res.data.cmp;
            this.d.activeList = res.data.all;
        });
    }

    public changeInstance(instance: string): void {
        this.d.activeInstance = instance;

        if (instance === "wish") {
            this.d.activeList = this.d.wish;
        } else if (instance === "cmp") {
            this.d.activeList = this.d.cmp;
        } else {
            this.d.activeList = this.d.cart;
        }
    }

    beforeMount() {
        this.attachToGlobal(this, [
            "addToCart",
            "changeInstance",
            "formatNum",
            "update"
        ]);
    }

    mounted() {
        this.loadAllCartItems();
    }
}
