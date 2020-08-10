<template>
    <div class="container">
        <div class="row" v-if="products.length > 0">
            <div class="col-3 m-2 p-4 border rounded" v-for="product in products" v-bind:key="product.id">
                <product-component :product="product"/>
            </div>
        </div>
        <div class="row" v-else>
            Loading...
        </div>
     <pagination-component :query="query"
         :offset="6"></pagination-component>
    </div>
</template>
 <script>
    import PaginationComponent from "./PaginationComponent";
    import ProductComponent from "./ProductComponent";
    import {mapState} from "vuex";
     export default {
        name: "ProductsComponent",
        components: {ProductComponent, PaginationComponent},


        data: function() {
            return {
                errors: null,
                query : '/getProducts?page='
            }
        },
        created() {
            Bus.$on('getProducts', this.get_products);
            },

        destroyed() {
            Bus.$off('get-products');
        },
        computed: {
            ...mapState({
                products: 'products'
            })
        },
        methods: {
            get_products: function (page) {
                this.$store.dispatch('getAllProducts', page);
            },

        }
    }
</script>
