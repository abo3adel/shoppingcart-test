import { Vue, Component } from 'vue-property-decorator';

export interface SuperData {
}

@Component({
    template: require('./index-template.html')
})
export default class Super extends Vue {
    public d: SuperData = {};

    /**
     * attach compoenent properties and methods to global d variable
     *
     * @param self current component instance
     * @param methods array of public methods
     */
    protected attachToGlobal(self: Super, methods: string[]) {
        for (const k in self.$data) {
            if (k === "d") {
                continue;
            }
            this.d[k] = this.$data[k];
        }

        methods.map(x => {
            this.d[x] = self[x];
        });
    }

    protected addClass(selector: string, cls: string) {
        const el = document.querySelector(selector) as HTMLElement;
        if (!el) return;
        el.classList.add(cls);
    }

    protected removeClass(selector: string, cls: string) {
        const el = document.querySelector(selector) as HTMLElement;
        if (!el) return;
        el.classList.remove(cls);
    }

    beforeMount() {}
}