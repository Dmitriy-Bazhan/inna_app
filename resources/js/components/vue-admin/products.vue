<template>
    <div>
        <h1>PRODUCTS</h1>

        <div class="container-fluid">

            <div class="row">

                <div class="col-2">Id</div>
                <div class="col-2">Category_id</div>
                <div class="col-2">Vendor Code</div>
                <div class="col-2">Name</div>
                <div class="col-2">Short Description</div>
                <div class="col-2">Price</div>

            </div>

            <div v-for="product in products" class="row">

                <div class="col-2">{{ product.id }}</div>
                <div class="col-2">{{ product.category_id }}</div>
                <div class="col-2">{{ product.vendor_code }}</div>
                <div class="col-2">{{ product.data.name }}</div>
                <div class="col-2">{{ product.data.short_description }}</div>
                <div class="col-2">{{ product.price }}</div>

            </div>

            <br>

            <div class="row">

                <div class="col-2">
                    <div v-on:click="getFirstPage()">First</div>
                </div>

                <div class="col-2">
                    <div v-on:click="getPrevPage()">Prev</div>
                </div>

                <div class="col-2">
                    <div v-on:click="getNextPage()">Next</div>
                </div>

                <div class="col-2">
                    <div v-on:click="getLastPage()">Last</div>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
export default {
    name: "products",
    data() {
        return {
            products: [],
            links: [],
            meta: []
        }
    },
    methods: {
        getNextPage() {
            axios.get(this.links.next)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    console.log(this.products);
                });
        },
        getPrevPage() {
            axios.get(this.links.prev)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    console.log(this.products);
                });
        },
        getLastPage() {
            axios.get(this.links.last)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    console.log(this.products);
                });
        },
        getFirstPage() {
            axios.get(this.links.first)
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                    console.log(this.products);
                });
        },
        getProducts() {
            axios.get('/api/products/')
                .then((response) => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
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
.col-2, .container-fluid {
    border: solid 1px black !important;
}

</style>
