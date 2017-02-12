
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var Vue = require('vue');
var VueRouter = require('vue-router');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
Vue.use(VueRouter);


import Users from './components/Users.vue';
import Example from './components/Example.vue';


const router = new VueRouter({
    hashbang: false,
    base: __dirname,
    linkActiveClass: 'active',

    routes:[
      {path: '/', component: Users, name: 'users'}
    ]
});

new Vue(Vue.util.extend({router}, Example)).$mount('#app')
