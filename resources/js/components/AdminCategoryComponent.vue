<template>
    <div class="position-relative">
        <div v-if="edit"  class="modal-edit position-absolute p-4 border bg-dark d-flex flex-column w-75" >
            <button type="button" class="ml-auto btn btn-outline-danger rounded-circle" @click="edit = !edit, updated = false"><i class="fa fa-close"></i></button>
            <form @submit.prevent="editCategory">
                <p v-if="updated" class="alert alert-success">category updated success</p>

                <input type="text" name="name" v-model="category.name"  class="form-control my-2">
                <textarea name="description" v-model="category.description" id="" cols="30" rows="10" class="form-control">{{category.description}}</textarea>
                <button type="submit" class="m-2 btn-primary ">update</button>
            </form>
        </div>
        <td>
            {{category.name}}
        </td>
        <td>
            {{category.description}}
        </td>
        <td class="row">
            <button @click="edit = !edit " class="mx-2 btn btn-outline-success">edit</button>
            <button @click="deleteCategory" class="btn btn-danger" type="button">delete</button>
        </td>
    </div>
</template>

<script>
    export default {
        name: "AdminCategoryComponent",
        props: {
            category: Object,

        },
        data(){
            return {
                edit: false,
                updated: false
            }
        },
        methods:{
            editCategory(){
                axios.post('/categories/'+this.category.id,{
                    name: this.category.name,
                    description : this.category.description,
                    _method : 'patch',
                })
                .then((response)=>{
                    console.log(response);
                    this.updated = true
                })
            },
            deleteCategory(){
                axios.post('/categories/'+this.category.id, {
                    _method: 'delete'
                })
                .then((response) =>{
                    Bus.$emit('getCategories');
                });
            }
        }
    }
</script>

<style scoped>
.modal-edit{
    z-index: 10;


}
</style>

