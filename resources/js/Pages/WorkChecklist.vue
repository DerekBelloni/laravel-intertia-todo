<template>
  <div class="bg-white">
  <Navbar>
    <div id="task-container" class="container mx-auto bg-white">
      <div class="flex justify-center">
        <div class="grow ml-8">
        <div class="ml-2 space-y-4">
          <div class="grid grid-cols-12">
            <div class="grid col-start-3 col-span-9">
              <div class="flex mt-8 text-lg px-2 items-center flex-row space-x-2 mb-6">
                <span class="font-semibold ml-4 text-gray-600">Work</span>
                <BriefcaseIcon class="h-6 w-6 text-teal-200"></BriefcaseIcon>
              </div>
              <Task :task="task" v-for="task in tasks"></Task>
              <div class="mt-2 ml-6">
                <a class="rounded p-1 cursor-pointer font-semibold text-gray-400 hover:text-teal-200" @click="toggleTaskField()">Add Task +</a>
              </div>
              <template v-if="toggleTask == true">
                <div class="mt-4 ml-6">
                <TaskField></TaskField>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </Navbar>
</div>
</template>


<script>
import { BriefcaseIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';
import Task from '@/Components/Task.vue';
import { ref, defineProps, onMounted, reactive } from 'vue';
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
    Navbar,
    PrimaryButton,
    TaskField,
    // Checkbox,
    Button,
    BriefcaseIcon,
    XCircleIcon,
    Task
  },
  setup(props) {
    // variables
    let toggleTask = ref(false);
    let checked = ref(false);
    let completedTasks = [];
    let workTasks = reactive([]);
    let value = null;

    // lifecycle hooks
    onMounted(() => {
      workTasks = props.tasks;
    })

    // functions -- try moving these outside the setup function
    function toggleTaskField() {
      toggleTask.value = !toggleTask.value;
    }


    // figure out how to preserve scroll position when you toggle
    // task complete
    function toggleTaskComplete(task_id, $event, workTasks){
      let taskChecked = {};
      taskChecked.task_id = task_id;
      taskChecked.task_complete = $event;
      for (let i = 0; i < workTasks.length; i++) {
        if (workTasks[i].id == taskChecked.task_id) {
          workTasks[i].task_completed = taskChecked.task_complete
        }
      }

      let params = workTasks;

      router.post('/WorkChecklist/Update' , params);
    }

    function deleteTask(taskToDelete) {
      let workTasksD = this.workTasks;
      let params = {
        'task_id': taskToDelete.id
      };
      
      this.workTasks = workTasksD.filter(t => t.id != taskToDelete.id);
      router.post('/WorkChecklist/Delete',  params);
    }

    function archiveTask(task) {
      let params = task;
      router.post('/ArchivedTask/Store', params);
    }

    return {
      workTasks,
      toggleTask,
      value,
      checked,
      completedTasks,
      toggleTaskField,
      toggleTaskComplete,
      deleteTask,
      archiveTask
    }
  }
}
</script>



<style>
  #task-container {
    width: 75vw;
  }

  template {
    background-color: white;
  }
</style>