<template>
    <div>
        <h2>Your products</h2>
        <admin-create-product-component />
        <table class="table table-light">
            <thead>
            <tr>
                <th>name</th>
                <th>categories</th>
                <th>price</th>
                <th>count</th>
            </tr>
            </thead>
            <tbody v-for="(product, i) in products" :key="product.id">

             <admin-product-component  :product="product"/>

            </tbody>
        </table>
        <pagination-component :query="query"
                              :offset="6"
                              />
    </div>
</template>
<script>
    import AdminProductComponent from "./AdminProductComponent";
    import PaginationComponent from "./PaginationComponent";
    import AdminCreateProductComponent from "./AdminCreateProductComponent";
    import {mapState} from 'vuex';
    export default {
        name: "AdminProductsComponent",
        components: {
            AdminProductComponent, PaginationComponent , AdminCreateProductComponent
        },
        data(){
            return {
                query: '/getProducts?page=',
            }
        },
        computed :{
            ...mapState({
                           products: 'products'
                       })

        },
        created() {
            Bus.$on('getProducts', this.get_products);
            this.get_products();
        },
        destroyed() {
          Bus.$off('getProducts');
        },
        methods: {
            get_products(page){
              this.$store.dispatch('getAllProducts', page);
            },
            deletedProduct(id){
                this.products.splice(this.products.indexOf(id, 1));
            }
        }
    }
</script>

<style scoped>

</style>
