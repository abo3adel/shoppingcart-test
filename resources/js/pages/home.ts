import { Vue } from "vue-property-decorator";
import Axios from "axios";
import { Component, Prop } from "vue-property-decorator";
import Super from "./super";
import CartItemInterface from "../interfaces/cart-item";

export interface HomeData {
    default: CartItemInterface[];
    wishlist: CartItemInterface[];
    compare: CartItemInterface[];
    activeInstance: string;
    activeList: CartItemInterface[];
    loading: boolean;
}

@Component
export default class Home extends Super {
    public d: HomeData = {
        // all your compnent data will be present in here
        default: [],
        wishlist: [],
        compare: [],
        activeInstance: "default",
        activeList: [],
        loading: true
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

            // if (instance === "wishlist") {
            //     this.d.wishlist.push(res.data);
            // } else if (instance === "compare") {
            //     this.d.compare.push(res.data);
            // } else {
            //     this.d.default.push(res.data);
            // }
            this.d[instance].push(res.data);

            if (this.d.activeInstance === instance) {
                this.d.activeList.push(res.data);
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
            this.d.default.map(x => {
                if (x.id === id) {
                    x.qty = type === "sub" ? x.qty - 1 : x.qty + 1;
                }
                return x;
            });

            this.successMes();
            loader.add("d-none");
        });
    }

    public destroy(id: number, instance: string): void {
        const loader = this.showLoader("del" + id);

        Axios.delete(`cart/${id}`, { data: { instance } }).then(res => {
            if (!res || res.status !== 204) {
                this.errorMes();
                loader.add("d-none");
                return;
            }

            this.addClass(`#${instance}${id}`, "d-none");
            this.d[instance] = this.d[instance].filter(
                (x: CartItemInterface) => {
                    return x.id !== id;
                }
            );
            this.successMes();
            loader.add("d-none");
        });
    }

    public loadAllCartItems(): void {
        Axios.get("/cart").then(res => {
            this.d.default = [...res.data.all];
            this.d.wishlist = [...res.data.wish];
            this.d.compare = [...res.data.cmp];
            this.d.activeList = [...res.data.all];
            this.d.loading = false;
        });
    }

    public changeInstance(instance: string): void {
        this.d.activeInstance = instance;

        if (instance === "wishlist") {
            this.d.activeList = [...this.d.wishlist];
        } else if (instance === "compare") {
            this.d.activeList = [...this.d.compare];
        } else {
            this.d.activeList = [...this.d.default];
        }
    }

    beforeMount() {
        this.attachToGlobal(this, [
            "addToCart",
            "changeInstance",
            "formatNum",
            "update",
            "destroy"
        ]);
    }

    mounted() {
        this.loadAllCartItems();
    }
}
