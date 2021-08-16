import VueRouter from 'vue-router';

import Users from './components/vue-admin/users';
import Products from './components/vue-admin/products';
import Posts from './components/vue-admin/posts';
import ProductEdit from './components/vue-admin/product-edit';

export default new VueRouter({
    routes : [
        {
            path: '/vue_admin/users',
            component: Users
        },
        {
            path: '/vue_admin/posts',
            component: Posts
        },
        {
            path: '/vue_admin/products',
            component: Products
        },
        {
            path : '/vue_admin/products/edit/:id',
            component: ProductEdit,
            name: 'productsEditId',
            props: true
        }

    ],
    mode : 'history'

    });
