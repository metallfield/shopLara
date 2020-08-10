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
    import {mapState} from "vuex";
      export default {
        name: "AdminCategoriesComponent",
        components: {CreateCategoryComponent},
        data(){
            return{
                query: '/getCategories?=page'
            }
        },
          computed:{
              ...mapState({
                  categories: 'categories'
              })
          },
        created() {
            Bus.$on('getCategories',  this.getCategories);

        },
         destroyed() {
           Bus.$off('getCategories');
         },
         methods:{
            getCategories(page){
              this.$store.dispatch('getAllCategories', page);
            }
        }
    }
</script>

<style scoped>

</style>
