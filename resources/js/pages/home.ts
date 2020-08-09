import { Vue } from "vue-property-decorator";
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

    public addToCart(id: number, instance: string): void {
        const loader = document.querySelector(
            `#spinner${id}${instance}`
        ) as HTMLElement;
        loader.classList.remove("d-none");

        Axios.post(`/cart/${id}`, { instance }).then(res => {
            if (!res) {
                loader.classList.add("d-none");
                this.$notify({
                    title: "Error",
                    text: "an unknown error had occured",
                    type: "error"
                });
                return;
            }
            if (res.status === 204) {
                loader.classList.add("d-none");
                this.$notify({
                    title: "Error",
                    text: "This product is already exists in cart",
                    type: "error"
                });
                return;
            }

            this.$notify({
                title: "Done",
                type: "success"
            });
            loader.classList.add("d-none");
        });
    }

    public loadAllCartItems(): void {
        Axios.get("/cart").then(res => {
            this.d.cart = res.data.all;
            this.d.wish = res.data.wish;
            this.d.cmp = res.data.cmp;
        });
    }

    beforeMount() {
        this.attachToGlobal(this, ["addToCart"]);
    }

    mounted() {
        this.loadAllCartItems();
    }
}
