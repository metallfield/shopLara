<template>
    <div class="container">
        <div class="row">
            <div class="col-3 m-2 p-4 border rounded" v-for="product in products">
                <img :src="'/storage/'+product.image" alt="" width="" height="100" class="w-100">
                <h4><a :href="'/productShow/'+product.id">{{product.name.slice(0, 30)}}</a></h4>
                <span class="text-success font-weight-bold">Price: {{product.price}}</span>
                <br><span class="badge badge-info mx-1" v-for="category in product.categories">
                    {{category.name}}
                </span>
                <br> <button v-if="product.count > 0" id="addProduct" :data-product="product.id" class="my-2 btn btn-outline-primary">Add to basket</button>
                <h5 v-else>product not allowed</h5>
                <div id="basket_details"></div>
            </div>
        </div>
        <pagination-component :pagination="pagination"
                              @paginate="get_products()"
                              :offset="4"
        ></pagination-component>
    </div>
</template>

<script>
    import PaginationComponent from "./PaginationComponent";
    export default {
        name: "ProductsComponent",
        components: {PaginationComponent},

        data: function() {
            return {
                products: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                errors: null

            }
        },
        created() {
          this.get_products()
        },
        methods: {
            get_products: function () {
                let vm = this
                let  url = '/getProducts'
                if (window.location.href.match('/?page='))
                {
                    url = window.location.href
                }
                axios.get(url)
                    .then( function(response){
                        console.log(response)
                        vm.products = response.data.data
                         vm.pagination = response.data

                    }).catch(function (error) {
                    vm.errors = error
                })
            }
        }
    }
</script>

<style scoped>

</style>
