<template>
    <div>
    <button v-if="button" class="btn btn-outline-primary" @click="showed = !showed, getBasket()">Basket</button>
        <a v-else
           @click="showed = !showed, getBasket()"
           class="nav-link"
        >Basket <i class="rounded-circle border-primary text-center text-primary p-1">{{countOfProducts}}</i></a>
    <div v-if="showed">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <button type="button" class="ml-auto btn btn-outline-danger rounded-circle" @click="showed = !showed"><i class="fa fa-close"></i></button>

                                <h2 class="text-center">basket</h2>
                                <h3 v-if="total > 0">Total sum: {{total}}</h3>
                                <h3 v-else>Basket is empty</h3>
                            <div class="d-flex flex-column overflow-auto">
                                <div class="col border p-3 w-100 " v-for="(product, i) in basket" :key="i">
                                <basket-product :product="product" :index="i" />
                                </div>
                            </div>
                        <a v-if="total > 0" href="/basket/place" class="my-3 btn btn-outline-success">Create Order</a>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import BasketProductComponent from "./BasketProductComponent";
    export default {
        name: "BasketComponent",
        components:{
            BasketProductComponent
        },
        props: {
            button : false
        },
        data(){
            return {
                showed : false,
                totalSum : 0,
                index: 0,
                basket: []
             }
        },
        computed:{

            total(){
            let sum = 0;
             this.basket.forEach((product)=>{
                 sum += product.pivot.count * product.price;
             })
                return sum;
            },
            countOfProducts(){
                 return this.basket.length;
            }
        },
        created() {
          Bus.$on("removeProduct", this.removeProduct);
          Bus.$on("incrementTotal", this.incrementTotal);
            Bus.$on("decrementTotal", this.decrementTotal);
        this.getBasket();

        },
        destroyed() {
            Bus.$off('removeProduct');
            Bus.$off('incrementTotal');
            Bus.$off('decrementTotal');

        },
        methods:{
            getBasket(){

                axios.get('/getBasket/')
                    .then((response)=>{
                        console.log(response.data);
                        this.basket = response.data.products;
                    })
            },
            removeProduct(product, index){
              //  this.$delete( this.basket, index)
            this.basket.splice(index, 1);
                this.decrementTotal(product.price);
            },
            incrementTotal(price){
                this.totalSum +=price;
            },
            decrementTotal(price){
                this.totalSum -=price;
            }
        }
    }
</script>

<style scoped>

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;

    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {

        max-width: 800px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 5%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
        overflow: auto;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
