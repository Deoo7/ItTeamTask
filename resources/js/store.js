// store.js (Vuex store)
// 
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    tasks: [],
  },
  mutations: {
    setTasks(state, tasks) {
      state.tasks = tasks;
    },
  },
  actions: {
    fetchTasks({ commit }) {
        axios.get('api/list')
          .then((response) => {
            commit('setTasks', response.data);
          })
          .catch((error) => {
            console.error('Error fetching tasks:', error);
          });
      },
  },
});