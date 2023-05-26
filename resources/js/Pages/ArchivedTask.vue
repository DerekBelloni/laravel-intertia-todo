<template>
  <div class="bg-white">
    <Navbar>
      <div class="container mx-auto mt-10">
        <div class="flex justify-center">
          <div class="grid grid-cols-8">
            <div class="grid col-start-2 col-span-6">
              <h3 class="text-gray-400 font-semibold text-lg">Archived Tasks</h3>
              <template class="border border-bottom border-gray-400" v-for="task in archivedTasks">
                <span class="mt-4 text-xs text-gray-400">{{ task.formatted_date }}</span>
                <span class="mt-2 text-gray-400">- {{ task.task_body }}</span>
              </template>
            </div>
          </div>
        </div>
      </div>
    </Navbar>
  </div>
</template>

<script>
import {reactive} from 'vue';
import Navbar from '@/Layouts/Navbar.vue';

export default {
  props: {
    archived_tasks: {
      type: Array,
      required: true
    }
  },
  components: {
    Navbar
  },
  setup(props) {
    let archivedTasks = reactive(props.archived_tasks);
    return {
      archivedTasks
    }
  }
}

</script>

<style>
  template {
    background-color: white;
  }
</style>