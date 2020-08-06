<template>
    <div>
    <button type="button" @click="create = !create, created = false" class="my-3 btn btn-outline-primary" >add product</button>
        <div v-if="create" class="border rounded p-4">
            <form @submit.prevent="addProduct" enctype="multipart/form-data">
                <p v-if="created" class="alert alert-success">category updated success</p>
                <label for="name">name</label>
                <input type="text" name="name" id="name" v-model="product.name"  class="form-control my-2">
                <label for="description">description</label>
                <textarea name="description"  id="description" cols="30" rows="10" class="form-control" v-model="product.description"></textarea>
                <label for="categories">categories</label>
                <ul class="overflow-auto p-3 border list-unstyled" id="categories"><li :class="{'text-success' : checked.includes(category.id)}"
                                                                             v-for="(category, i) in categories" :key="category.id"
                                                                             @click="checked.includes(category.id) ? checked.splice(checked.indexOf(category.id, 1)) : checked.push(category.id) ">
                    {{category.name}}</li></ul>
                <input type="file"
                       @change="onFileChange"
                       class="form-control-file">
                <label for="price">price</label>
                <input type="text" name="price" id="price" class="my-2 form-control" v-model="product.price">
                <label for="count">count</label>
                <input type="text" name="count" id="count" class="form-control" v-model="product.count">
                <button type="submit" class="m-2 btn btn-primary ">update</button>
            </form></div>
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        name: "AdminCreateProductComponent",
        data(){
            return {
                create : false,
                checked: [],
                created: false,
                product:{
                    name : '',
                    description: '',
                    price: '',
                    count: '',

                },
                image: '',
                imageName: ''
            }
        } ,
        created() {
          this.getCategories();
        },
        computed: {
            ...mapState({
                categories: 'categories'
            })
        },
        methods: {
            getCategories(){
                this.$store.dispatch('getAllCategories');
                },
            onFileChange(e) {
                this.image =  e.target.files[0] || e.dataTransfer.files;
                let number = Math.random() // 0.9394456857981651
                number.toString(36); // '0.xtis06h6'
                let id = number.toString(36).substr(2, 9); // 'xtis06h6'
                this.imageName = id+'_'+this.image.name;
            },
            addProduct(){
                axios.post('/products', {
                    name : this.product.name,
                    description: this.product.description,
                    price: this.product.price,
                    count: this.product.count,
                    imageName: this.imageName,
                    categories: this.checked
                }).then((response)=>{
                    this.created = true;
                    this.product = '';
                    this.checked = '';
                    console.log(response);
                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }
                    let formData = new FormData();
                    formData.append('image', this.image);
                    formData.append('imageName', this.imageName);
                    axios.post('/uploadImageForProduct', formData, config )
                        .then((response)=>{
                            console.log(response);
                        })
                    Bus.$emit('getProducts');
                })
            }
            }

    }
</script>

<style scoped>

</style>
