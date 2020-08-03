<template>
    <div>
    <img :src="'/storage/'+product.image" alt="" width="" height="100" class="w-100">
    <h4><a :href="'/productShow/'+product.id">{{product.name.slice(0, 30)}}</a></h4>
    <span class="text-success font-weight-bold">Price: {{product.price}} $</span>
    <br><span class="badge badge-info mx-1" v-for="category in product.categories">
                    {{category.name}}
                </span>
    <br> <button v-if="product.count > 0" id="addProduct" :data-product="product.id" class="my-2 btn btn-outline-primary">Add to basket</button>
    <h5 v-else>product not allowed</h5>
    <div id="basket_details"></div>
    </div>
</template>

<script>
    export default {
        name: "ProductComponent",
        props: {
            product: {
                type: Object
            }
        }
    }
</script>
