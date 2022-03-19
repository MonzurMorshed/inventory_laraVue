require('./bootstrap');

import {createApp} from 'vue';
window.Vue = require('vue');

import App from './components/App.vue';
import { createWebHistory, createRouter } from "vue-router";
import VueAxios from 'vue-axios';
import axios from 'axios';
import { routes } from './routes';

import Toaster from '../../node_modules/@meforma/vue-toaster';
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css';
// optional set default imeout, the default is 10000 (10 seconds).

const router = new createRouter({
    history: createWebHistory(),
    routes: routes
});

createApp(App)
    .use(Toaster)
    .use(VueAxios, axios)
    .use(router)
    .mount('#app')

