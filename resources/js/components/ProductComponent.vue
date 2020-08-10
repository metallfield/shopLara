<template>
    <div>
    <img :src="'/storage/'+product.image" alt="" width="" height="100" class="w-100">
    <h4><a :href="'/productShow/'+product.id">{{product.name.slice(0, 30)}}</a></h4>
    <span class="text-success font-weight-bold">Price: {{product.price}} $</span>
    <br><span class="badge badge-info mx-1" v-for="category in product.categories">
                    {{category.name}}
                </span>
    <br> <div id="addBasket"><add-product v-if="product.count > 0"
                        :product="product"
    />
    <h5 v-else>product not allowed</h5></div>
    <div id="basket_details"></div>
    </div>
</template>

<script>
    import AddProductComponent from "./AddProductComponent";
    export default {
        name: "ProductComponent",
        components: {
          AddProductComponent
        },
        props: {
            product: {
                type: Object
            }
        }
    }
</script>
