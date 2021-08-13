require('./bootstrap');

require('alpinejs');

import Vue from 'vue';

import VueRouter from 'vue-router';
import router from './router';

Vue.component('vue-chat-component', require('./components/vue-chat.vue').default);

import VueAdminMain from './components/vue-admin/vue-admin-main';

Vue.use(VueRouter);

window.onload = function () {
    let element = $('body').attr('data-user-id');
    if (element !== undefined) {
        const app = new Vue({
            el: '#vue-chat',
        });
    }

    const app1 = new Vue({
        el: '#vue-admin-main',
        render: h => h(VueAdminMain),
        router
    });
}
