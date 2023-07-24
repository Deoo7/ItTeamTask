require('./bootstrap');

import Vue from 'vue';
import { InertiaApp } from '@inertiajs/inertia-vue';

Vue.use(InertiaApp);

const app = document.getElementById('app');

new Vue({
  render: (h) => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: (name) => require(`./components/${name}`).default,
    },
  }),
}).$mount(app);
