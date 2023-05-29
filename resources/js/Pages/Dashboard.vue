<template>
  <div class="bg-gray-100">
    <Navbar>
      <div class="container mx-auto">
        <div class="flex justify-center mt-20">
          <div class="flex flex-col">
            <font-awesome-icon class="text-blue-500 text-xl" icon="hat-wizard" />
            <span class="font-semibold text-gray-600 text-center">
              {{ datetime_pieces.day }}, {{ datetime_pieces.month }} {{ datetime_pieces.date }}
            </span>
            <span class="font-bold text-2xl text-gray-600 text-center">
              Good {{time_of_day}}, {{user.name}}!
            </span>
            <div class="grid grid-cols-2 mt-4 bg-gray-100 rounded-full shadow py-1 px-2 divide-x divide-gray-300 grow border border-rose-300">
              <div class="flex justify-center items-center">
                <font-awesome-icon class="text-amber-600 pr-2" :icon="['fas', 'check']" />
                <p class="font-bold text-gray-600">{{ incomplete_tasks }} tasks</p>
              </div>
              <div class="flex justify-center">
                <p class="font-bold text-gray-600">0 projects</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container mx-auto">
        <div class="grid grid-cols-12">
          <div class="col-start-2 col-span-5 mt-10 mr-2">
            <div class="bg-gray-50 rounded shadow border">
              <div class="flex items-center my-2 border-b pl-2 pb-2">
                <font-awesome-icon class="h-8 w-8 text-gray-600" :icon="['far', 'circle-user']" />
                <span class="font-semibold text-gray-600 ml-4">My Tasks</span>
              </div>
              <div class="flex flex-row ml-4 items-center border-b pb-2">
                <p class="font-semibold text-gray-600">Add a task...</p>
                <form class="flex flex-grow" @submit.prevent="handleSaveTask()">
                  <input v-model="taskBody" class="h-6 ml-4 w-3/4 rounded-xl border-gray-200 focus:border-gray-300 focus:ring-0 shadow-inner" type="text"/>
                </form>
              </div>
              <div v-for="task in activeTasks">
                <div v-if="!task.task_completed">
                  <div class="ml-4 border-b border-gray-200 pb-2">
                    <span class="text-gray-600 font-semibold ">{{ task.checklist_item_body }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-start-7 col-span-5 mt-10 ml-2">
            <div class="bg-gray-50 rounded shadow border">
              <div class="flex items-center my-2 border-b pl-2 pb-2">
                <span class="font-semibold text-gray-600 ml-4">Projects</span>
              </div>
              <div class="ml-4 text-center my-4" v-if="!projects">
                <span class="text-gray-600 font-semibold">You currently have no projects. Get started!</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Navbar>
  </div>
</template>

<script >
import Navbar from '@/Layouts/Navbar.vue';
import { ref, onMounted, reactive } from 'vue';
import useSaveTask from "@/Composables/useSaveTask";
const { saveTask } = useSaveTask();

export default{
  props: {
    user: {
      type: Object,
      required: true
    },
    datetime_pieces: {
      type: Object,
      required: true
    },
    incomplete_tasks: {
      type: Number,
      required: true
    },
    tasks: {
      type: Array,
      required: true
    },
    time_of_day: {
      type: String,
      required: true
    }
  },
  components: {
    Navbar
  },
  setup(props) {
    let activeTasks = reactive(props.tasks);
    let taskBody = ref('');
    let url = "/WorkChecklist/Store";

    function handleSaveTask() {
      let task_body = taskBody.value;
      saveTask(url, task_body, {parent_task_id: null, subtask_type: null});
    }

    return {
      activeTasks,
      handleSaveTask,
      taskBody
    }
  }
}
</script>

<style>
  /* template {
    background-color: white;
  } */
</style>
