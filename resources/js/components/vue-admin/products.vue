<template>
    <h1>PRODUCTS</h1>
</template>

<script>
export default {
    name: "products",
    data() {
        return {
            products: []
        }
    },
    methods: {
        getProducts() {
            // axios.get('/api/getProducts?api_token=' + 'fIqKrJ9Roc7SRAp8VCPgFMKg2a04QUZymS6kfqGBhixesjss9PE35ajKvmbmFMhKXmu9NYPpDEcF7YHQ')
            axios.get('/api/getProducts')
                .then((response) => {
                    console.log(response.data.products);
                    this.products = response.data.products;
                });
        },
    },
    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>

</style>
