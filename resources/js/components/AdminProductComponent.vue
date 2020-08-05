<template>


        <tr> <div v-if="edit" >
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">

                            <button type="button" class="ml-auto btn btn-outline-danger rounded-circle" @click="edit = !edit, updated = false"><i class="fa fa-close"></i></button>
                            <form @submit.prevent="editProduct" enctype="multipart/form-data">
                                <p v-if="updated" class="alert alert-success">category updated success</p>

                                <input type="text" name="name" v-model="product.name"  class="form-control my-2">
                                <textarea name="description" v-model="product.description" id="" cols="30" rows="10" class="form-control">{{product.description}}</textarea>
                                <ul class="overflow-auto my-3 p-3 border list-unstyled" ><li :class="{'text-success' : checked.includes(category.id)}"
                                v-for="(category, i) in categories" :key="category.id" v-model="product.categories"
                                @click="checked.includes(category.id) ? checked.splice(checked.indexOf(category.id, 1)) : checked.push(category.id) ">
                                    {{category.name}}</li></ul>
                                <input type="file"
                                    @change="onFileChange"
                                        class="form-control-file">
                                <input type="text" name="price" class="my-2 form-control" v-model="product.price">
                                <input type="text" name="count" class="form-control" v-model="product.count">
                                <button type="submit" class="m-2 btn-primary ">update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
            <div v-if="showed">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-container">

                                <button type="button" class="ml-auto btn btn-outline-danger rounded-circle" @click="showed = !showed"><i class="fa fa-close"></i></button>
                                <div class="row">
                                    <div class="col d-flex justify-content-end "><img :src="'/storage/'+ product.image" alt="" width="300" height="300"></div>
                                    <div class="col ">
                                        <h2>{{product.name}}</h2>
                                        <h4>price: {{product.price}}$</h4>
                                        <h4>Categories: </h4>
                                        <ul class="list-unstyled my-3"><li v-for="category in product.categories">
                                           <span class="badge badge-info text-white">{{category.name}}</span>
                                        </li></ul>
                                        <p class="border rounded p-3">
                                         <span class="font-weight-bold">description: </span>   {{product.description}}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </transition>
            </div>
    <td>
        {{product.name}}
    </td>
    <td >
        <span v-for="category in product.categories" class="font-weight-bold">{{category.name}}, </span>
    </td>
    <td>{{product.price}}$</td>
    <td>{{product.count}}</td>
            <td>
                <button type="button" class="btn btn-outline-primary rounded-circle" @click="showed = !showed"><i class="fa fa-eye-slash"></i></button>
                 <button @click="edit = !edit" class="btn btn-outline-primary">edit</button>
                <button @click="deleteProduct"  class="btn btn-danger">delete</button>
            </td>
        </tr>

</template>

<script>
    import {mapState} from "vuex";

    export default {
        name: "AdminProductComponent",
        props: {
            product : {
                type : Object
            },
        },
        data(){
            return {
                edit : false,
                showed: false,
                updated : false,
                checked : [],
                 image: '',
            }
        },
        created(){
          this.getCategories();
        },
        computed: {
            ...mapState({
                categories: 'categories'
            })
        },
        methods: {
            editProduct(){
                let formData = new FormData();
                formData.append('image', this.image);
                axios.post('/products/'+this.product.id, {
                    name : this.product.name,
                    description : this.product.description,
                    categories: this.checked,
                    price: this.product.price,
                    count: this.product.count,
                    image: formData,
                    imageName: this.image.name,
                    _method : 'patch'
                }).then((response)=>{
                    console.log(response)
                    Bus.$emit('getProducts');
                })
            },
            getCategories(){
             this.$store.dispatch('getAllCategories');
                this.product.categories.forEach((category) =>{
                    this.checked.push(category.id);
                });
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                this.image = Array.from(files);
                console.log(this.image);
                if (!files.length)
                    return;

            },

            deleteProduct(){
                axios.post('/products/'+this.product.id, {
                    _method : 'delete'
                })
                .then((response)=>{
                    console.log(response);
                    Bus.$emit('getProducts');
                })
            }
        }
    }
</script>

<style scoped>
    ul{
        max-height: 100px;
    }
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        max-width: 800px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
        overflow: auto;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
