
require('./bootstrap');
import Vue from 'vue';
Vue.component('countdown', require('@chenfengyuan/vue-countdown').default);


const app = new Vue({
    el: '#app',
});
