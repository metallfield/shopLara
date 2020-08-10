<template>
    <div>
        <h3>Total orders at site: <span class="my-2 text-success">{{ordersStatistic.count}}</span></h3>
        <h3>Total Sum of Orders: <span class="my-2 text-success">{{ordersStatistic.price}}</span></h3>
        <line-chart :chartData="month" v-if="loaded"></line-chart>
        <div v-else><h2>there will be orders statistic...</h2> </div>

    </div>
</template>

<script>
import LineChart from '../LineChart.js';
    export default {
        name: "OrdersStatisticComponent",
        components: {
          LineChart
        },
        data(){
            return{
                ordersStatistic: [],
                loaded: false,
                orderStats: {
                    items:[],

                },
                month: {
                    type:Object,
                    num: [],
                    orders: [],

                },
                 months : [ "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December" ]
            }
        },

         created() {
           this.getOrdersStatistic();
           this.getTotalSum()
        },
        methods: {
            getOrdersStatistic(){
                axios.get('/getOrdersStatistic')
                    .then((response)=>{
                        console.log(response.data);
                        this.orderStats = response.data;
                        const month = Object.keys(this.orderStats);
                        month.forEach((item)=>{
                            console.log(item)
                            this.month.num.push(this.months[item-1])
                        })
                        const orders = Object.values(this.orderStats);
                        orders.forEach((item)=>{
                            console.log(item)
                            const it = Object.values(item);
                            let sum = 0;
                            it.forEach((i)=>{
                                console.log(i)
                                sum+= i;
                            })
                            this.month.orders.push(sum)
                        })
                        this.loaded = true;
                    })
            },
            getTotalSum()
            {
                axios.get('/getTotalOrdersSum')
                .then((response)=>{
                    console.log(response.data)
                    this.ordersStatistic = response.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>
