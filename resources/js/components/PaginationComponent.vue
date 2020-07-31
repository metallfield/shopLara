<template>

  <ul class="pagination">
        <li v-if="pagination.current_page > 1" class="p-2 border rounded">
            <a href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li v-for="page in pagesNumber" class="border p-2 rounded" >
            <a href="javascript:void(0)" v-if="page == pagination.current_page" class="text-dark" v-on:click.prevent="changePage(page)">{{ page }}</a>

            <a href="javascript:void(0)" v-else v-on:click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page" class="p-2 border rounded">
            <a href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "PaginationComponent",
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },

        created(){
            console.log(this.pagination.per_page)
        },
        computed: {
            pagesNumber() {
                if (!this.pagination.to) {
                    return [];
                }
                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }
                return pagesArray;
            }
        },
        methods: {
            changePage(page) {

                this.pagination.current_page = page;
                history.pushState(null, null, '/getProducts?page='+page);
                this.$emit('paginate');
            }
        }
    }
</script>

<style scoped>

</style>
