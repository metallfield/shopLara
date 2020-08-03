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
  </div>
</template>

<script>

    import CreateCategoryComponent from "./CreateCategoryComponent";
     export default {
        name: "AdminCategoriesComponent",
        components: {CreateCategoryComponent},
        data(){
            return{
                categories: []
            }
        },
        created() {
            Bus.$on('getCategories',  this.getCategories);
            this.getCategories();
        },
        methods:{
            getCategories(){
                axios.get('/getCategories')
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
