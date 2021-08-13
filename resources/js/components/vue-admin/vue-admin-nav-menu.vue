<template>
    <ul class="list-group admin-nav-menu-list">
        <li class="list-group-item  admin-nav-menu-list-item">
            <router-link class="admin-nav-menu-list-item-link" to="/vue_admin/users">Пользователи</router-link>
        </li>
        <li class="list-group-item  admin-nav-menu-list-item">
            <router-link class="admin-nav-menu-list-item-link" to="/vue_admin/posts">Статьи</router-link>
        </li>
        <li class="list-group-item admin-nav-menu-list-item">
            <router-link class="admin-nav-menu-list-item-link" to="/vue_admin/products">Продукция</router-link>
        </li>
    </ul>
</template>

<script>
export default {
    name: "vue-admin-nav-menu"
}
</script>

<style scoped>

</style>
