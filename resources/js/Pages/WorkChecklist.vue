<template>
  <Navbar>
    <div>
      <div class="grid grid-cols-12">
        <div class="col-start-4 col-span-5 ml-2 space-y-4">
          <div class="flex mt-8 text-lg px-2 items-center flex-row space-x-2">
            <span class="font-semibold ml-4">Work</span>
            <BriefcaseIcon class="h-6 w-6 text-gray-300"></BriefcaseIcon>
          </div>
          <div class="ml-6 space-y-4">
            <div class="flex flex-grow-0 items-center border-b border-gray-200 pb-2" v-for="task in workTasks" :key="task.id">
              <Checkbox :checked="task.task_completed" :value="value"  @update:checked="toggleTaskComplete(task.id, $event, workTasks)"></Checkbox>
                <div class="ml-4">
                  <span class="flex justify-end decoration-neutral-300	" :class="task.task_completed ? 'line-through' : ''">{{ task.checklist_item_body }}</span>
                </div>
                <div class="ml-12" v-if="task.task_completed">
                  <a class="hover:bg-gray-300" @click="deleteTask(task)"><XCircleIcon class="h-6 w-6 text-gray-200 cursor-pointer hover:text-red-500" ></XCircleIcon></a>
                </div>
            </div>
          </div>
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
  </Navbar>
</template>


<script>
import { BriefcaseIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';
import { ref, defineProps, onMounted } from 'vue';
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
    Checkbox,
    Button,
    BriefcaseIcon,
    XCircleIcon
  },
  setup(props) {
    // variables
    let toggleTask = ref(false);
    let checked = ref(false);
    let completedTasks = [];
    let workTasks = ref([]);
    let value = null;

    // lifecycle hooks
    onMounted(() => {
      workTasks.value = props.tasks;
    })

    // functions
    function toggleTaskField() {
      toggleTask.value = !toggleTask.value;
    }

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

      // Inertia.post('/WorkChecklist/Update' , params);
      router.post('/WorkChecklist/Update' , params);
    }

    function deleteTask(taskToDelete) {
      let workTasksD = this.workTasks;
      let params = {
        'task_id': taskToDelete.id
      };
      this.workTasks = workTasksD.filter(t => t.id != taskToDelete.id);
      router.post('WorkChecklist/Delete',  params);
    }

    return {
      workTasks,
      toggleTask,
      value,
      checked,
      completedTasks,
      toggleTaskField,
      toggleTaskComplete,
      deleteTask
    }
  }
}
</script>



<style>

</style>