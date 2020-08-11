<template>
    <div>
        <h2>categories statistic</h2>
        <div class="row">
            <div class="col-7">
                <ul>
                    <li v-for="(category, i) in catStatistic" class="row justify-content-around p-3 border rounded flex-nowrap">
                        <i class="">{{i+1}}</i>
                        <h5>{{category.name}}</h5>
                        <h6>Count of Products: {{category.countProducts}}</h6>
                    </li>
                </ul>
            </div>
            <div class="col-4">
        <pie-chart v-if="loaded" :names="names" :counts="counts" :colors="colors"></pie-chart>
                <span v-else>Loading...</span>
            </div>
        </div>


    </div>
</template>

<script>
    import PieChart from "../PieChart";
    export default {
        name: "CategoriesStatisticComponent",
        components: {
          PieChart
        },
        data(){
            return{
                catStatistic: [],
                names: [],
                counts: [],
                colors: [],
                loaded: false
            }
        },
        created() {
            this.getCategoriesStatistic();
        },
        methods:{
            getCategoriesStatistic(){
                axios.get('/getCategoriesStatistic')
                .then((response)=>{
                    console.log(response.data);
                    this.catStatistic = response.data;
                    this.catStatistic.forEach((item)=>{
                        this.names.push(item.name);
                        this.counts.push(item.countProducts);
                        this.colors.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
                    })
                    this.loaded = true;
                })
            }
        }
    }
</script>

<style scoped>

</style>
