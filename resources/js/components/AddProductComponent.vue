<template>
    <div>
<button type="button" v-if="!added" @click="added = !added, addProduct()" class="btn btn-outline-success">Add to Basket</button>
    <basket-component v-if="added"
                        :button="true"
    />
    </div>
</template>

<script>
    import BasketComponent from "./BasketComponent";
    export default {
        name: "AddProductComponent",
        components: {
          BasketComponent
        },
        props: {
          product: {
              type : Object
          }
        },
        data(){
            return{
                added : false
            }
        },
        methods: {
            addProduct()
            {
                this.$store.dispatch('addProduct', this.product);
            }
        }
    }
</script>

<style scoped>

</style>
