import { Component, Prop } from 'vue-property-decorator';
import Super from './super';

export interface HomeData {}

@Component
export default class Home extends Super {
    public d: HomeData = {
        // all your compnent data will be present in here

    };
    
    public log() {
        console.log('log is working');
    }

    beforeMount() {
        this.attachToGlobal(this, ['log']);
    }
}