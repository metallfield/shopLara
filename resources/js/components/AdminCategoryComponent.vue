<template>
    <div class="position-relative">
        <div v-if="edit" >
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">

                        <button type="button" class="ml-auto btn btn-outline-danger rounded-circle" @click="edit = !edit, updated = false"><i class="fa fa-close"></i></button>
            <form @submit.prevent="editCategory">
                <p v-if="updated" class="alert alert-success">category updated success</p>

                <input type="text" name="name" v-model="category.name"  class="form-control my-2">
                <textarea name="description" v-model="category.description" id="" cols="30" rows="10" class="form-control">{{category.description}}</textarea>
                <button type="submit" class="m-2 btn-primary ">update</button>
            </form>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <td>
            {{category.name}}
        </td>
        <td>
            {{preview}}<template v-if="category.description.length>100">&hellip;</template>
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
        computed : {
            preview() {
                return this.category.description.slice(0, 100);
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
    width: 500px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
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

