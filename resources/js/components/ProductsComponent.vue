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
     <pagination-component :offset="6"></pagination-component>
    </div>
</template>

<script>
    import PaginationComponent from "./PaginationComponent";
    import ProductComponent from "./ProductComponent";
    export default {
        name: "ProductsComponent",
        components: {ProductComponent, PaginationComponent},

        data: function() {
            return {
                 products: [],
                errors: null
            }
        },
        created() {
            Bus.$on('get-products', this.get_products);
        },

        destroyed() {
            Bus.$off('get-products');
        },

        methods: {
            get_products: function (page) {
                let  url = '/getProducts?page=' + page;
               console.log(url);
                axios.get(url)
                    .then(({data}) => {
                        console.log(data)
                        this.products = data.data
                    }).catch((error) => {
                    this.errors = error
                })
            },

        }
    }
</script>
