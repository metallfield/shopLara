<template>
    <div>
        <button @click="create = !create" class=" my-3 btn btn-outline-primary">add category</button>
    <div v-if="create" class="p-4 border rounded">
        <form @submit.prevent="createCategory" >
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control my-2" v-model="name">
            <label for="description">description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" v-model="description"></textarea>
            <button type="submit" class="my-2 btn btn-outline-primary">create</button>
        </form>
    </div>
    </div>
</template>
<script>
    export default {
        name: "CreateCategoryComponent",
        data() {
            return {
                create: false,
                name : '',
                description: ''
            }
        },
         methods:{
            createCategory(){
                axios.post('/categories', {
                    name : this.name,
                    description: this.description
                }).then((response)=>{
                    this.name = '';
                    this.description = '';
                    Bus.$emit('getCategories');
                })
            }
        }
    }
</script>

<style scoped>

</style>
