<template>
  <div class="w-[80%] m-auto">
  <div class="flex justify-end mt-8">
      <button @click="showModal = true" type="button" id="addtask" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Task</button>
    </div>
    <div class="flex flex-col">
  <div class="-m-1.5 overflow-x-auto py-4">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead>
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task Name</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Edit</th>
              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Remove</th>
            </tr>
          </thead>
          <tbody v-if="tasks.length" class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="task in tasks" :key="task.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ task.id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ task.title }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ task.status }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a class="text-blue-500 hover:text-blue-700" href="#">Edit</a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a class="text-blue-500 hover:text-blue-700" href="#">Remove</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<AddTask v-if="showModal" @close="showModal = false" />
</div>
</template>

<script>
import AddTask from './AddTask.vue';

export default {
  name: "Welcome",
  components: {
    AddTask,
  },
  data() {
    return {
      showModal: false,
    };
  },
  computed: {
    tasks() {
      return this.$store.state.tasks;
    },
  },
  created() {
    if (!this.tasks.length) {
      this.$store.dispatch('fetchTasks');
    }
  },
};
</script>