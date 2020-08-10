<template>
    <div class="container-fluid">
        <h2>Statistic Page</h2>
        <div class="row">
            <div class="col-3">
            <div class=" border rounded p-3 bg-success pointer text-center" @click="productStatistic = true , ordersStatistic = false" >
                <h3>products statistic</h3>
            </div>
        <div class=" border rounded p-3 bg-info pointer text-center" @click="ordersStatistic = !ordersStatistic , productStatistic = !productStatistic" >
            <h3>Orders statistic</h3>
        </div>
            </div>
    <div class="col-7">
            <product-statistic :productStatistic="statistic"
                                :topProducts="TopProducts"
                               v-if="productStatistic"
            />
            <orders-statistic v-if="ordersStatistic"
            />  </div></div>
    </div>
</template>

<script>

    import ProductsStatisticComponent from "./ProductsStatisticComponent";
    import OrdersStatisticComponent from "./OrdersStatisticComponent";
    export default {
        name: "StatisticComponent",
        components: {
          ProductsStatisticComponent,
            OrdersStatisticComponent
        },
        data(){
            return{
                statistic : [],
                productStatistic : true,
                ordersStatistic : false,
                TopProducts: [],
            }
        },
        created() {
          this.getStatistic();
        },
        methods: {
            getStatistic()
            {
               axios.get('/getStatistic')
                .then((response)=>{
                    console.log(response.data);
                    this.statistic = response.data;
                })
            },


        }
    }
</script>

<style scoped>
.pointer{
    cursor: pointer;
}
</style>
