/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';


window.Bus = new Vue();
import Vuex from 'vuex';

 Vue.use(Vuex);
import storeData from './strore/index';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const store = new Vuex.Store(
    storeData,

)
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('products', require('./components/ProductsComponent.vue').default);
Vue.component('pagination-component', require('./components/PaginationComponent').default);
Vue.component('product-component', require('./components/ProductComponent').default);
Vue.component('admin-categories-component', require('./components/AdminCategoriesComponent').default);
Vue.component('admin-category-component', require('./components/AdminCategoryComponent').default);
Vue.component('create-category-component', require('./components/CreateCategoryComponent').default);
Vue.component('admin-products-component', require('./components/AdminProductsComponent').default);
Vue.component('admin-product-component', require('./components/AdminProductComponent').default);
Vue.component('admin-create-product-component', require('./components/AdminCreateProductComponent').default);
Vue.component('basket-component', require('./components/BasketComponent').default);
Vue.component('add-product', require('./components/AddProductComponent').default);
Vue.component('basket-product', require('./components/BasketProductComponent').default);
Vue.component('incoming-orders-component', require('./components/IncomingOrdersComponent').default);
Vue.component('incoming-order-component', require('./components/IncomingOrderComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el:'#order',
    store,
})
new Vue({
    el: '#adminCats',
    store,
})
new Vue({
    el: '#addBasket',
    store,
})
new Vue({
    el: '#basket',
    store,
})
new Vue({
    el: '#adminProducts',
    store,
})

const product = new Vue({
    el: '#products',
      store,

});






