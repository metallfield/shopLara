<template>
    <div>
        <h2>Your products</h2>
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
    </div>
</template>

<script>
    import AdminProductComponent from "./AdminProductComponent";
    export default {
        name: "AdminProductsComponent",
        components: {
            AdminProductComponent
        },
        data(){
            return {
                products: [],
                query: '/getProducts?=page',
            }
        },
        created() {
            this.get_products();
        },
        methods: {
            get_products(page){
                let url = this.query + page;
                axios.get(url)
                .then(({data})=>{
                    this.products = data.data;
                    console.log(data.data)
                })
            }
        }
    }
</script>

<style scoped>

</style>
