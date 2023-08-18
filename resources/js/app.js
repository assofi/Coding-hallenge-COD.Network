import './bootstrap';

import Vue from 'vue';
import ProductList from './components/ProductList.vue';

Vue.component('product-list', ProductList);

const app = new Vue({
    el: '#app',
});
