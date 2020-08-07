<template>
    <div class="container">
        <h2>Statistic Page</h2>
            <div class="col-5 border rounded p-3 bg-success pointer" @click="productStatistic = !productStatistic " @click.once="getStatistic()">
                <h3>products statistic</h3>
            </div>
        <div v-if="productStatistic" class="w-100 p-4">
            <h4>total products positions on site: <span class="text-success font-weight-bold">{{statistic.count}}</span></h4>
            <h4>total sum of products: <span class="text-success font-weight-bold">{{statistic.sum}}$</span></h4>
            <button @click="showTrending = !showTrending" @click.once="getTopTrending()" class="pointer my-2  p-2 btn btn-info">show top 10 of trending</button>
            <div v-if="showTrending">
            <h4>Most Trending Product: </h4>
            <div class="row align-items-baseline justify-content-around">
                <div class="p-2 col-4">
                <div class="border bg-light">
                    <img :src="'/storage/'+TopProducts[0][0].image" alt="" class="w-100" height="150">
                    <h4 class="text-center font-weight-bold"><a :href="'/productShow/'+TopProducts[0][0].id">{{TopProducts[0][0].name}}</a></h4>
                    <h5 class="text-success mx-3 text-center">price: {{TopProducts[0][0].price}}$</h5>
                </div>
                <h5 class="text-capitalize mx-1 align-self-center">with trending count : {{TopProducts[0].countTrending}}</h5>
                </div>
            <div class="col-6">
            <ul class="list-unstiled border p-3 my-3 overflow-auto">
                <li v-for="(product, i) in TopProducts" class="row font-weight-bold align-items-center my-2 justify-content-around">
                    <span class="mx-2"> {{i+1}}</span>
                    <img :src="'/storage/'+product[i].image" alt="" width="80" height="80" class="mr-auto">
                    <h6 class="mx-auto p-2 font-weight-bold text-capitalize"><a :href="'/productShow/'+product[i].id">{{product[i].name.slice(0, 30)}}</a></h6>
                    <h6 class="mx-2">count of trending: {{product.countTrending}}</h6>
                </li>
            </ul>
            </div>
        </div></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StatisticComponent",
        data(){
            return{
                statistic : [],
                productStatistic : false,
                showTrending: false,
                TopProducts: []
            }
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
            getTopTrending()
            {
                axios.get('/getTopTrendingProducts')
                .then((response)=>{
                    console.log(response.data);
                    this.TopProducts = response.data;
                })
            }
        }
    }
</script>

<style scoped>
.pointer{
    cursor: pointer;
}
</style>
