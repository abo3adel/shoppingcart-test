import Axios from "axios";
import { Component, Prop } from "vue-property-decorator";
import Super from "./super";
import CartItemInterface from "../interfaces/cart-item";

export interface HomeData {
    cart: CartItemInterface[];
    wish: CartItemInterface[];
    cmp: CartItemInterface[];
}

@Component
export default class Home extends Super {
    public d: HomeData = {
        // all your compnent data will be present in here
        cart: [],
        wish: [],
        cmp: []
    };

    // public addToCart(instance: string): void {
    //     Axios.post('/')
    // }

    public loadAllCartItems(): void {
        Axios.get("/cart").then(res => {
            this.d.cart = res.data.all;
            this.d.wish = res.data.wish;
            this.d.cmp = res.data.cmp;
        });
    }

    beforeMount() {
        this.attachToGlobal(this, []);
    }

    mounted() {
        this.loadAllCartItems();
    }
}
