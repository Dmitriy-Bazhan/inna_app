<template>
    <div>
        <h1>PRODUCTS</h1>


        <div class="container-fluid">

            <div class="row">

                <div class="col-1">Id</div>
                <div class="col-1">Category_id</div>
                <div class="col-2">Vendor Code</div>
                <div class="col-2">Name</div>
                <div class="col-4">Short Description</div>
                <div class="col-1">Price</div>
                <div class="col-1">Action</div>

            </div>

            <hr>

            <spinner v-if="loading"></spinner>
            <div v-else v-for="product in products" class="row product-line-block">

                <div class="col-1 inner-product-line-block">{{ product.id }}</div>
                <div class="col-1 inner-product-line-block">{{ product.category_id }}</div>
                <div class="col-2 inner-product-line-block">{{ product.vendor_code }}</div>
                <div class="col-2 inner-product-line-block">{{ product.data[0].name }}</div>
                <div class="col-4 inner-product-line-block">{{ product.data[0].short_description }}</div>
                <div class="col-1 inner-product-line-block">{{ product.price }}</div>
                <div class="col-1">
                    <router-link :to="{name: 'productsEditId',params:{id:product.id}}" tag="button">Е
                    </router-link>
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-2 offset-2">
                    <div class="pagination-button" v-on:click="getFirstPage()">First</div>
                </div>

                <div class="col-2">
                    <div class="pagination-button" v-on:click="getPrevPage()">Prev</div>
                </div>

                <div class="col-2">
                    <div class="pagination-button" v-on:click="getNextPage()">Next</div>
                </div>

                <div class="col-2">
                    <div class="pagination-button" v-on:click="getLastPage()">Last</div>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
import Spinner from './spinner';

export default {
    components: {
        Spinner
    },
    name: "products",
    data() {
        return {
            products: [],
            links: [],
            meta: [],
            loading: true
        }
    },
    methods: {
        getNextPage() {
            axios.get(this.links.next)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                });
        },
        getPrevPage() {
            axios.get(this.links.prev)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                });
        },
        getLastPage() {
            axios.get(this.links.last)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                });
        },
        getFirstPage() {
            axios.get(this.links.first)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                });
        },
        getProducts() {
            axios.get('/api/products/')
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    this.loading = false;
                    console.log(this.products);
                });
        },
    },
    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>

.product-line-block {
    border-bottom: dotted 1px gray;
}

.product-line-block:hover {
    background: #18c139;
}

.inner-product-line-block {
    color: dimgray;
    font-weight: 600;
    font-size: 16px;
}

.pagination-button {
    border: solid 1px black;
    border-radius: 10px;
    text-align: center;
}

.pagination-button:hover {
    background: dodgerblue;
    color: white;
}

</style>
