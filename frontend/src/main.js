import { createApp } from 'vue';
import App from './App.vue';
import router from "./router";
import AOS from 'aos';
import 'aos/dist/aos.css';
import i18n from './i18n';
import store from "./state/store";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import BootstrapVueNext from 'bootstrap-vue-next';
import vClickOutside from "click-outside-vue3";
import VueApexCharts from "vue3-apexcharts";
import { vMaska } from "maska"

import VueFeather from 'vue-feather';

import '@/assets/scss/config/interactive/app.scss';
import '@/assets/scss/mermaid.min.css';
import 'bootstrap/dist/js/bootstrap.bundle'

import axios from 'axios';
import Notifications from '@kyvg/vue3-notification';

axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default axios;

AOS.init({
    easing: 'ease-out-back',
    duration: 1000
});

createApp(App)
    .use(Notifications)
    .use(store)
    .use(router)
    .use(VueApexCharts)
    .use(BootstrapVueNext)
    .component(VueFeather.type, VueFeather)
    .directive("maska", vMaska)
    .use(i18n)
    .use(VueSweetalert2)
    .use(vClickOutside).mount('#app');