<template>
<div class="ml-6 space-y-4">
  <div class="flex flex-col border-t border-gray-200 py-2 px-2" v-for="task in workTasks"       :key="task.id">
      <div>
        <div class="flex justify-start">
          <Checkbox :checked="task.task_completed" :value="value"  @update:checked="toggleTaskComplete(task.id, $event)"></Checkbox>
          <div class="ml-4">
            <span class="flex  decoration-zinc-500	text-sm" :class="task.task_completed ? 'line-through' : ''">{{ task.checklist_item_body }}</span>
          </div>
        </div>
      </div>
      <div class="flex items-baseline justify-between">
        <div class="mt-10">
          <span class="text-xs">{{ task.created_at }}</span>
        </div>
        <div class="flex justify-end mt-10 text-xs items-center space-x-2 pr-3 hover:bg-gray-300 hover:rounded hover:px-1 hover:py-1 hover:text-white">
          <label for="my-modal-5"><PencilSquareIcon class="h-6 w-6 hover:bg-gray-400 rounded px-1"></PencilSquareIcon></label>
          <a class="hover:bg-gray-400 px-1 rounded" :class="task.task_completed ? 'cursor-pointer font-medium' : 'cursor-pointer pr-2 font-medium'" @click="archiveTask(task)"><span >Archive Task</span></a>
          <div class="flex justify-end" v-if="task.task_completed">
          <a @click="deleteTask(task)"><XCircleIcon class="h-6 w-6 text-gray-200 cursor-pointer hover:text-red-500 flex" ></XCircleIcon></a>
        </div>
        </div>
      </div>
      <!-- Modal -->
      <input type="checkbox" id="my-modal-5" class="modal-toggle" />
      <div class="modal" :v-model="taskBody">
        <div class="modal-box w-11/12 max-w-3xl bg-white">
          <h3 class="font-bold text-lg">Edit Task</h3>
          <div class="mt-2 flex justify-center">
            <textarea id="modal-taskfield" v-model="task.checklist_item_body" class="textarea border border-gray-200 bg-white" rows="2" cols="55" placeholder="Create a task..." ></textarea>
          </div>
          <div class="modal-action">
            <label for="my-modal-5" class="btn btn-outline btn-xs" @click="saveTask(task)">Submit</label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { BriefcaseIcon } from '@heroicons/vue/24/solid';
import { BookmarkSquareIcon } from '@heroicons/vue/24/solid';
import { PencilSquareIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import Navbar from '@/Layouts/Navbar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TaskField from '@/Components/TaskField.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';
import { ref, defineProps, onMounted, reactive, computed } from 'vue';
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
    XCircleIcon,
    PencilSquareIcon,
    BookmarkSquareIcon
},
  setup(props) {
    let toggleTask = ref(false);
    let checked = ref(false);
    let completedTasks = [];
    let workTasks = ref([]);
    let value = null;
    let taskBody = '';
    const isActive = ref(true);




    onMounted(() => {
      workTasks.value = props.tasks;
    })

    // functions -- try moving these outside the setup function
    function toggleTaskField() {
      toggleTask.value = !toggleTask.value;
    }


    // figure out how to preserve scroll position when you toggle
    // task complete
    function toggleTaskComplete(task_id, $event){
      let taskChecked = {};
      taskChecked.task_id = task_id;
      taskChecked.task_completed = $event;

      for (let i = 0; i < this.workTasks.length; i++) {
        if (this.workTasks[i].id == taskChecked.task_id) {
          this.workTasks[i].task_completed = taskChecked.task_completed
        }
      }

      let params = this.workTasks;
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
      // consider using a Set, doesn't allow duplicate values
      console.log('task: ', task);
      let params = task;
      router.post('/ArchivedTask/Store', params);
    }

    function saveTask(task) {
      console.log('save task coming from modal: ', task)
      // let params = {
      //     task_body: task
      // }
      // Inertia.post('/WorkChecklist/Store', params);
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
      archiveTask,
      isActive,
      taskBody,
      saveTask
    }
  }
}
</script>

<style>
  #modal-taskfield {
    width: 600px;
  }

  textarea {
    resize: none;
  }
</style>