<template>
    <div  class="w-100 p-4">
        <h4>total products positions on site: <span class="text-success font-weight-bold">{{productStatistic.count}}</span></h4>
        <h4>total sum of products: <span class="text-success font-weight-bold">{{productStatistic.sum}}$</span></h4>
         <div >
            <h4>Most selling Product: </h4>
            <div class="row align-items-baseline justify-content-between">
                <div class="col-8" style="height: 600px!important; overflow: auto">
                    <table class="table table-light table-sm mt-0" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>name</th>
                            <th>price</th>
                            <th>count of sells</th>

                        </tr>
                        </thead>
                        <tbody v-for="(product, i) in topProducts[0]" class="">
                        <tr  >
                            <th class="mx-2"> {{i+1}}</th>
                            <td>   <img :src="'/storage/'+product.image" alt="" width="80" height="80" class=""></td>
                            <td class=" font-weight-bold text-capitalize"><a :href="'/productShow/'+product.id">{{product.name.slice(0, 30)}}</a></td>
                            <td><span>{{product.price}}</span></td>
                            <td>{{topProducts.count[product.id]}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-2 col-3" v-for="(product, i) in topProducts[0]">
                    <div class="border bg-light" v-if="i === 0">
                        <img :src="'/storage/'+product.image" alt="" class="w-100" height="150">
                        <h4 class="text-center font-weight-bold"><a :href="'/productShow/'+product.id">{{product.name}}</a></h4>
                        <h5 class="text-success mx-3 text-center">price: {{product.price}}$</h5>
                    </div>
                </div>

            </div></div>
    </div>
</template>

<script>
    export default {
        props: ['productStatistic'],
        name: "ProductsStatisticComponent",
        data(){
            return {
                showTrending: false,
                topProducts: [],

            }
        },
        created() {
          this.getTopTrending();
        },
        methods: {
            getTopTrending()
            {
                axios.get('/getTopTrendingProducts')
                    .then((response)=>{
                        console.log(response.data);
                        this.topProducts = response.data;
                        console.log(this.topProducts)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
