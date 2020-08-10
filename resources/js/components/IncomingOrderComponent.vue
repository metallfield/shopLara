<template>

    <tr @click="showInfo = !showInfo" class="position-relative border" >
         <td>{{order.name}}</td>
        <td>{{order.address}}</td>
        <td>{{order.email}}</td>
        <td>{{updated_at}}</td>
        <td>{{totalPrice}}$</td>

        <div style="" class=" border p-3 " v-if="showInfo">
            <transition name="modal">
                <div class="modal-mask" @click="!showInfo">
                    <div class="modal-wrapper">
                        <div class="modal-container">
            <div v-for="product in order.products" class="d-flex flex-column justify-content-between">
                <div v-if="product.user_id === user_id" class="row justify-content-between my-2 border p-3">
                    <div class="col"><img :src="'/storage/'+ product.image" alt="" width="100" height="100"></div>
                    <div class="col mx-2 "><h4><a :href="'/productShow/'+product.id">name:{{product.name}}</a></h4></div>
                    <div class="col mx-2"><h5>price:{{product.price}}$</h5></div>
                    <div class="col"><h5>count: {{product.pivot.count}}</h5></div>
                    <div class="col"><h5>{{product.price * product.pivot.count}}</h5></div>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </transition>
        </div>
    </tr>

</template>

<script>
    export default {
        name: "IncomingOrderComponent",
        props: {
            order: {
                type: Object,
                products: {
                    type : Object,
                    product: []
                }
            },
            user_id: 0
        },
        data(){
            return  {
                showInfo : false
            }
        },
        computed: {
            updated_at(){
               let d= new Date(this.order.updated_at);
                return   d.getFullYear()+'-'+d.getMonth()+'-'+d.getDay()+':'+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
            },
            totalPrice(){
                let sum = 0;
                this.order.products.forEach((product)=>{
                    if (product.user_id === this.user_id)
                    {
                        sum += product.pivot.count * product.price;
                    }
                })
                return sum;
            }
        }
    }
</script>

<style scoped>
    tr:hover{
        cursor: pointer;
    }
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
        min-width: 900px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
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
