<template>
    <ul class="pagination">
        <li class="pagination-item">
            <button
                type="button"
                @click="onPageChange(1)"
                :disabled="isInFirstPage"
                aria-label="Go to first page"
            > First
            </button>
        </li>
        <li class="pagination-item" >
            <button
                type="button"
                @click="onPageChange(current_page -1)"
                :disabled="isInFirstPage"
                aria-label="Go to previous page"
            >  Previous
            </button>
        </li>
        <li v-for="page in pages" class="pagination-item">
            <button
                type="button"
                @click="onPageChange(page.name)"
                :disabled="page.isDisabled"
                :class="{ active: isPageActive(page.name) }"
                :aria-label="`Go to page number ${page.name}`"
            >   {{ page.name }}
            </button>
        </li>

        <li class="pagination-item">
            <button
                type="button"
                @click="onPageChange(current_page + 1)"
                :disabled="isInLastPage"
                aria-label="Go to next page"
            >
                Next
            </button>
        </li>

        <li class="pagination-item">
            <button
                type="button"
                @click="onPageChange(last_page)"
                :disabled="isInLastPage"
                aria-label="Go to last page"
            >
                Last
            </button>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "PaginationComponent",
        props: {
            offset: {
                type: Number,
                default: 4
            },
        },
        data(){
            return{
                current_page: 0,
                last_page: 0,
            }
        },
        created(){
            this.getProductsStats();
            console.log(this.pages)
        },
        computed: {
            startPage() {
                if (this.current_page === 1) {
                    return 1;
                }
                if (this.current_page === this.last_page) {
                    return this.last_page - this.offset + 1;
                }
                return this.current_page - 1;
            },
            endPage() {
                return Math.min(this.startPage + this.offset - 1, this.last_page);
            },
            pages() {
                const range = [];
                for (let i = this.startPage; i <= this.endPage; i+= 1 ) {
                    if (i > 0)
                    {
                        range.push({
                            name: i,
                            isDisabled: i === this.current_page
                        });
                    }

                }
                return range;
            },
            isInFirstPage() {
                return this.current_page === 1;
            },
            isInLastPage() {
                return this.current_page === this.last_page;
            },
        },
        methods: {
            isPageActive(page) {
                return this.current_page === page;
            },
            getProductsStats() {
                let url =  '/getProducts?page=' + this.current_page;
                axios.get(url)
                    .then(({data}) => {
                        this.last_page = data.last_page;
                        this.onPageChange(data.current_page);
                    });
            },
            onPageChange(page) {
                this.current_page = page;
                Bus.$emit('get-products' , this.current_page);
            },

        }
    }
</script>

<style scoped>

</style>
