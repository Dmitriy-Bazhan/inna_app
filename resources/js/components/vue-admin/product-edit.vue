<template>
    <div>
        <h1>PRODUCT EDIT</h1>

        <div class="container-fluid">

            <div class="row">

                <div class="col-4 offset-8">

                    <div class="btn btn-info" v-on:click="saveChanges">Изменить</div>
                    <router-link class="btn btn-danger" to="/vue_admin/products">Отмена</router-link>

                </div>

            </div>

        </div>

        <label class="control-label">Артикул</label>
        <input class="form-control input_in_admin" v-if="errors.vendor_code !== undefined" v-model="product.vendor_code"
               placeholder="Артикул" style="color: red;">
        <input class="form-control input_in_admin" v-else v-model="product.vendor_code" placeholder="Артикул">

        <label class="control-label">Поисковая строка</label>
        <input class="form-control input_in_admin" v-if="errors.search_string !== undefined"
               v-model="product.search_string" placeholder="Поисковая строка" style="color: red;">
        <input class="form-control input_in_admin" v-else v-model="product.search_string"
               placeholder="Поисковая строка">

    </div>
</template>

<script>
export default {
    name: "product-edit",
    props: ['id'],
    data() {
        return {
            product: [],
            errors: []
        }
    },
    methods: {
        saveChanges() {
            axios.patch('/api/products/' + this.product.id, this.product)
                .then((response) => {
                    if (response.data.success) {
                        this.errors = [];
                        // window.location.href = 'http://app.lock/vue_admin/products';
                        this.$router.go(-1);

                    } else {
                        this.errors = [];
                        this.errors = response.data.errors;
                    }

                }).catch((errors) => {
                console.log('ERRORS');
                console.log(errors);
            })
            ;
        },
        getProduct(id) {
            axios.get('/api/products/' + id + '/edit')
                .then((response) => {
                    this.product = response.data.data[0];
                });
        },
    },
    mounted() {
        this.getProduct(this.id);
    }
}
</script>

<style scoped>

</style>
