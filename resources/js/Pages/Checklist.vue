<template>
  <Navbar>
    <div id="task-container">
      <div class="">
        <div class="grow ml-8">
        <div class="ml-2 space-y-4">
          <div class="grid grid-cols-12 h-full">
            <div class="grid col-start-3 col-span-9">
              <div class="flex mt-8 text-lg px-2 items-center flex-row space-x-2 mb-6">
                <span class="font-semibold ml-4 text-gray-500">Tasks</span>
              </div>
              <Task :task="task" v-for="task in tasks" :key="task.id" @opening:modal="toggleTaskField($event)"></Task>
              <div class="mt-2 ml-6">
                <a class="rounded p-1 cursor-pointer font-semibold text-gray-400 hover:text-rose-500" @click="toggleTaskField()">Add Task +</a>
              </div>
              <div v-if="toggleTask == true">
                <div class="mt-4 mb-8 ml-6">
                <TaskField @saveTask="handleSaveTask"></TaskField>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </Navbar>
</template>


<script>
import { BriefcaseIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Button from '@/Components/Button.vue';
import Task from '@/Components/Task.vue';
import useSaveTask from "@/Composables/useSaveTask";
import { ref, onMounted, reactive } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { router } from '@inertiajs/vue3';

export default {
  props: {
    tasks: {
      type: Array,
      required: true
    }
  },
  components: {
    Button,
    BriefcaseIcon,
    Navbar,
    PrimaryButton,
    Task,
    TaskField,
    XCircleIcon
  },
  setup(props) {
    // variables
    let checked = ref(false);
    let completedTasks = [];
    let toggleTask = ref(false);
    let value = null;
    let url = "/Checklist/Store";
    const { saveTask } = useSaveTask();

    // functions -- try moving these outside the setup function
    function archiveTask(task) {
      let params = task;
      router.post('/ArchivedTask/Store', params);
    }

    function deleteTask(taskToDelete) {
      let workTasksD = this.workTasks;
      let params = {
        'task_id': taskToDelete.id
      };
      
      this.workTasks = workTasksD.filter(t => t.id != taskToDelete.id);
      router.post('/Checklist/Delete',  params);
    }

    function handleSaveTask(task) {
      saveTask(url, task, {parent_task_id: null, subtask_type: null});
    }

    function toggleTaskField(flag = null) {
      console.log('flag here: ', flag);
      if (flag === "task") {
        toggleTask.value = false;
      } else {
        toggleTask.value = !toggleTask.value;
      }
    }

    return {
      archiveTask,
      checked,
      completedTasks,
      deleteTask,
      handleSaveTask,
      saveTask,
      toggleTask,
      toggleTaskField,
      url,
      value
    }
  }
}
</script>



<style>
  #task-container {
    width: 75vw;
    height: 100%;
  }

  template {
    background-color: white;
  }
</style>