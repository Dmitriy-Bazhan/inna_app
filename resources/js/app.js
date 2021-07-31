require('./bootstrap');

require('alpinejs');

import Vue from 'vue';

window.Vue = require('vue');

Vue.component('test-component', require('./components/test.vue').default);

window.onload = function () {
    const app = new Vue({
        el: '#app',
    });
}
