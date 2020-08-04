<template>
  <div class="container">
      <h2>Categories List</h2>
      <create-category-component />
       <table class="table table-light">
          <thead>
          <tr>
              <th>id</th>
              <th>name</th>
              <th>description</th>
          </tr>
          </thead>
          <tbody v-for="(category, i ) in categories" :key="i">
          <tr>
          <th scope="row">{{i}}</th>
              <admin-category-component :category="category" />
          </tr>
          </tbody>
      </table>
      <pagination-component :offset="6"
                            :query="query"
      />
  </div>
</template>

<script>

    import CreateCategoryComponent from "./CreateCategoryComponent";
      export default {
        name: "AdminCategoriesComponent",
        components: {CreateCategoryComponent},
        data(){
            return{
                categories: [],

                query: '/getCategories?=page'
            }
        },
        created() {
            Bus.$on('getCategories',  this.getCategories);

        },
         destroyed() {
           Bus.$off('getCategories');
         },
         methods:{
            getCategories(page){
                let url = '/getCategories?page='+ page;
                axios.get(url)
                .then(({data})=>{
                    console.log(data.data);
                    this.categories = data.data;

                })
            }
        }
    }
</script>

<style scoped>

</style>
