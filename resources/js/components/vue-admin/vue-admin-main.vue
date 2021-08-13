<template>

    <div class="container-fluid">

        <div class="row">

            <div class="col-2 left-nav-menu-main-block">

                <nav-menu></nav-menu>

            </div>

            <div class="col-10">

                <router-view></router-view>

            </div>

        </div>

    </div>

</template>

<script>
import NavMenu from './vue-admin-nav-menu';

export default {
    name: "vue-admin-main",
    components: {NavMenu},
}
</script>

<style scoped>

</style>
