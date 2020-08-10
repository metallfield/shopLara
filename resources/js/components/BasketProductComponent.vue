<template>
    <div class="row p-2 justify-content-around align-content-around">
        <h4 class="mx-2 border-left border-right p-2 w-100 h-100">name: {{product.name}}</h4>
        <img :src="'/storage/'+product.image" alt="" width="100" height="100">
        <h5 class="mx-2 border-left border-right text-center my-auto">count: <button @click.prevent="plusProduct" class="mx-2 btn btn-outline-success btn-sm rounded-circle">+</button>{{product.pivot.count}} <button @click.prevent="minusProduct" class="mx-2 btn btn-outline-danger btn-sm rounded-circle">-</button></h5>
        <h5 class="mx-2 border-left border-right my-auto">price: {{product.price}}</h5>
        <h5 class="mx-2 border-left border-right my-auto">price for count: {{priceForCount}}</h5>
    </div>
</template>

<script>
    export default {
        name: "BasketProductComponent",
        props:{
            index: Number,
            product : {
                type : Object
            }
        },
        computed : {
            priceForCount(){
                return this.product.price * this.product.pivot.count;
            }
        },
        methods: {
            plusProduct(){
                if (this.product.pivot.count < this.product.count)
                {
                    this.$store.dispatch('addProduct', this.product);
                    this.product.pivot.count ++;
                    Bus.$emit('incrementTotal', this.product.price);
                }
            },
            minusProduct(){
                console.log(this.index);
                if (this.product.pivot.count < 2)
                {
                    Bus.$emit('removeProduct', this.product, this.index);
                }else {
                    this.product.pivot.count --;
                }
                this.$store.dispatch('remove_product', this.product);
                Bus.$emit('decrementTotal', this.product.price);
            }
        }
    }
</script>

<style scoped>

</style>
