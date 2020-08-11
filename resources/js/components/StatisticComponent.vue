<template>
    <div class="container-fluid">
        <h2>Statistic Page</h2>
        <div class="row">
            <div class="col-3">
            <div class=" border rounded p-3 bg-success pointer text-center" @click="state = 'products'" >
                <h3>products statistic</h3>
            </div>
        <div class=" border rounded p-3 bg-info pointer text-center" @click="state = 'orders'" >
            <h3>Orders statistic</h3>
        </div>
                <div class=" border rounded p-3 bg-warning pointer text-center" @click="state = 'categories'" >
                    <h3>Categories statistic</h3>
                </div>
            </div>
    <div class="col-7">
            <product-statistic :productStatistic="statistic"
                                :topProducts="TopProducts"
                               v-if="state==='products'"
            />
            <orders-statistic v-if="state==='orders'"
            />
            <categories-statistic  v-if="state==='categories'"/>
    </div></div>
    </div>
</template>

<script>

    import ProductsStatisticComponent from "./ProductsStatisticComponent";
    import OrdersStatisticComponent from "./OrdersStatisticComponent";
    import CategoriesStatisticComponent from "./CategoriesStatisticComponent";
    export default {
        name: "StatisticComponent",
        components: {
          ProductsStatisticComponent,
            OrdersStatisticComponent,
            CategoriesStatisticComponent
        },
        data(){
            return{
                statistic : [],
                state: {
                    type: String,

                },
                TopProducts: [],
            }
        },
        created() {
          this.getStatistic();
          this.state= 'products';
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
