require('./bootstrap');

require('alpinejs');

import Vue from 'vue';

window.Vue = require('vue');

Vue.component('vue-chat-component', require('./components/vue-chat.vue').default);

window.onload = function () {
    const app = new Vue({
        el: '#vue-chat',
    });
}
