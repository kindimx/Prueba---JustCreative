require('./bootstrap');
import store from './store'
import router from './routes'
import App from "./App.vue"

const app = new Vue({
    el: '#root',
    render: h => h(App),
    store,
    router
});
