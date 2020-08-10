<template>
    <div>
    <h2>Incoming Orders</h2>
        <table class="table table-light">
            <thead>
            <tr>

                <th>name</th>
                <th>address</th>
                <th>email</th>
                <th>date</th>
                <th>full price</th>

            </tr>
            </thead>
            <tbody v-for="order in orders">
                <incoming-order-component :order="order" :user_id="user_id" />
            </tbody>
        </table>
    </div>
</template>


<script>
    import IncomingOrderComponent from './IncomingOrderComponent';
    import {mapState} from 'vuex';
    export default {
        name: "IncomingOrdersComponent",
        components: {
            IncomingOrderComponent
        },
        props:{
          user_id: 0
        },
        created() {
            this.getOrders();
            },
        computed: {
          ...mapState({
              orders: 'incomingOrders'
          })
        },
        methods:{
            getOrders(){
                return this.$store.dispatch('getIncomingOrders');
            }
        }
    }
</script>

<style scoped>

</style>
