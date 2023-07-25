require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import store from './store';
import { InertiaApp } from '@inertiajs/inertia-vue';

Vue.use(InertiaApp);
Vue.use(Vuex);

const app = document.getElementById('app');

new Vue({
  render: (h) => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: (name) => require(`./components/${name}`).default,
    },
  }),
  store,
}).$mount(app);
