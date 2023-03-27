<template>
  <Navbar>
    <div>
      <div class="grid grid-cols-12">
        <div class="col-start-3 col-span-4 ml-4">
          <div class="flex mt-8 text-lg px-2 items-center">
            <span class="font-semibold">Work</span>
            <a class="rounded p-1 cursor-pointer font-semibold" @click="toggleTaskField()">+</a>
          </div>
          <template v-if="toggleTask == true">
            <div class="mt-4">
            <TaskField></TaskField>
            </div>
          </template>
          <div>
            <div class="flex flex-row items-center" v-for="task in tasks" :key="task.id">
              <Checkbox :checked="task.task_completed" :value="value"  @update:checked="toggleTaskComplete(task.id, $event, workTasks)"></Checkbox>
              <div class="ml-4">
                <span>{{ task.checklist_item_body }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Navbar>
</template>


//FIXME - Checkboxes aren't reflecting task_completed status on page load
<script>
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';
import { ref, defineProps, onMounted } from 'vue';
import { Inertia } from "@inertiajs/inertia";
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
    Button
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
      console.log('props: ', props.tasks);
      workTasks.value = props.tasks;
      console.log('work tasks: ', workTasks)
    })

    // functions
    function toggleTaskField() {
      toggleTask.value = !toggleTask.value;
    }

    function toggleTaskComplete(task_id, $event, workTasks){
      console.log('toggle tasks complete: ', workTasks.value);
      let taskChecked = {};
      taskChecked.task_id = task_id;
      taskChecked.task_complete = $event;
      for (let i = 0; i < workTasks.length; i++) {
        if (workTasks[i].id == taskChecked.task_id) {
          workTasks[i].task_completed = taskChecked.task_complete
          console.log('for loop: ', workTasks[i]);
        }
      }

      let params = workTasks

      // console.log('params: ', params)

      Inertia.post('/WorkChecklist/Update' , params);
      // console.log('taskChecked: ', taskChecked);
      // completedTasks.push(taskChecked);
      // console.log(completedTasks);
    }

    return {
      workTasks,
      toggleTask,
      value,
      checked,
      completedTasks,
      toggleTaskField,
      toggleTaskComplete
    }
  }
}
</script>

<!-- <script setup>
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';
import { ref, defineProps, onMounted, computed } from 'vue';

let toggleTask = ref(false);
let checked = ref(false);
let completedTasks = [];
let workTasks = ref([]);
let value = null;

defineProps({
  tasks: {
    type: Array,
    required: true
  }
});

beforeUpdate(() => {
  console.log('props: ', props.tasks)
  // workTasks.value = props.tasks;
  // console.log('work tasks: ', workTasks);
})


function toggleTaskField() {
  toggleTask.value = !toggleTask.value;
}

function toggleTaskComplete(task_id, $event){
  let taskChecked = {};
  taskChecked.task_id = task_id;
  taskChecked.task_complete = $event;
  console.log('taskChecked: ', taskChecked);
  completedTasks.push(taskChecked);
  console.log(completedTasks);
}

</script> -->