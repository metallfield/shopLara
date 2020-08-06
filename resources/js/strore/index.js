
import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex);

export default {
    state: {
        products: [],
        categories: [],
        basket: {
            products: [],
        },
        incomingOrders: []

    },

    actions : {
        getAllProducts(context, page){
            axios.get('/getProducts?page='+page)
                .then((response)=>{
                    console.log('dispatching success');
                    context.commit("product", response.data.data);
                })
        },
        getAllCategories(context, page){
            axios.get('/getCategories?page='+page)
                .then((response)=>{
                    context.commit("categories", response.data.data);
                })
        },
        getBasketProducts(context)
        {
            axios.get('/getBasket/')
                .then((response)=>{
                    console.log(response.data);
                    context.commit("basket", response.data);
                })
        },
        addProduct(context, product)
        {
            axios.post('/basket/add/'+ product.id)
                .then((response)=>{
                    console.log(response);
                 })
        },
        remove_product(context, product)
        {
            axios.post('/basket/remove/'+ product.id)
                .then((response)=>{
                    console.log(response);
                 })
        },
        getIncomingOrders(context, page){
            axios.get('/getIncomingOrders')
                .then((response)=>{
                    console.log(response.data)
                    context.commit('setIncomingOrders', response.data);
                })
        }
    },
    getters : {
      getBasket: state => {
          return state.basket.products;
      },
        basketTotal: state => {
          return state.total;
        },

    },
    mutations: {
        product(state, data){
            return state.products = data;
        },
        categories(state, data){
            return state.categories = data;
        },
        basket(state, data) {
            return state.basket = data;
        },
        setIncomingOrders(state, data){
            return state.incomingOrders = data;
        }

    }
};

