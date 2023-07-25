<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-4 rounded-lg shadow-lg">
      <div class="w-full grid justify-items-end">
        <button @click="close" type="button" class="bg-white rounded-md p-2 inline-flex items-end justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
              <span class="sr-only">Close menu</span>
              <!-- Heroicon name: outline/x -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
      </div>
        <div
  class="block max-w-md rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
  <form class="w-full max-w-lg" @submit.prevent="submitForm">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Task Name
      </label>
      <input v-model="title" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" name="title" placeholder="title">
      <p v-if="errors.title" class="text-red-500 text-xs italic">{{ errors.title[0] }}</p>
  </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Text
      </label>
      <textarea v-model="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="textarea" name="text" placeholder="text"></textarea>
      <p v-if="errors.text" class="text-red-500 text-xs italic">{{ errors.text[0] }}</p>
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-[80%] px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        Status
      </label>
      <div class="relative">
        <select v-model="status" name="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
          <option>ToDo</option>
          <option>Reject</option>
          <option>Complete</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-end mt-4">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add Task</button>
        </div>
</form>
</div>
      </div>
                <!-- <button @click="close" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Close</button> -->

    </div>
  </template>
  
  <script>
import axios from 'axios';

export default {
  data() {
    return {
      title: '',
      text: '',
      status: 'ToDo',
      errors: {},
    };
  },
  methods: {
    close() {
      this.$emit('close');
    },
    submitForm() {
      const formData = {
        title: this.title,
        text: this.text,
        status: this.status,
      };

      axios.post('/api/tasks', formData)
        .then(response => {
          this.title = '';
          this.text = '';
          this.status = 'ToDo';
          this.errors = {};
          window.location.reload();
        })
        .catch(error => {
            if (error.response.status === 422) {
                this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>
  