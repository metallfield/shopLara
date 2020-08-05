
import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex);

export default {
    state: {
        products: [],
        categories: [],
        basket: {
            products: []
        }
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
                    context.commit('setBasket', response.data);
                })
        },
        addProduct(context, payload)
        {
            axios.post('/basket/add/'+ payload.product.id)
                .then((response)=>{
                    context.commit('addToBasket', payload.product);
                })
        }
    },
    mutations: {
        product(state, data){
            return state.products = data;
        },
        categories(state, data){
            return state.categories = data;
        },
        setBasket(state, data)
        {
            return state.basket.products = data;
        },
        addToBasket(state, product)
        {
            return state.basket.products.push(product);
        }
    }
};

