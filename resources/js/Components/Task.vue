<template>
<div class="ml-6 space-y-4">
  <div class="flex flex-col border-t border-gray-200 py-2 px-2">
      <div>
        <div class="flex justify-start items-center">
          <Checkbox :checked="activeTask.task_completed" :value="value"  @update:checked="toggleTaskComplete($event)"></Checkbox>
          <div class="ml-4">
            <span class="flex font-thin text-gray-400 decoration-zinc-500	text-sm" :class="activeTask.task_completed ? 'line-through' : ''">{{ activeTask.checklist_item_body }}</span>
          </div>
        </div>
      </div>
      <div class="flex items-baseline justify-between">
        <div>
          <span class="text-xs text-gray-400">{{ task.created_at }}</span>
        </div>
        <div class="flex justify-end mt-6 text-xs items-center space-x-2 pr-3 hover:bg-gray-300 hover:rounded hover:px-1 hover:py-1 hover:text-white">
          <label for="my-modal-5"><PencilSquareIcon class="h-6 w-6 text-gray-400 hover:bg-gray-400 hover:text-white rounded px-1" @click="showModal(task)"></PencilSquareIcon></label>
          <a class="hover:bg-gray-400 px-1 rounded" :class="task.task_completed ? 'cursor-pointer font-medium text-gray-400 hover:text-white' : 'cursor-pointer pr-2 font-medium text-gray-400 hover:text-white'" @click="archiveTask(task)"><span >Archive Task</span></a>
          <div class="flex justify-end" v-if="task.task_completed">
          <a @click="deleteTask(task)"><XCircleIcon class="h-6 w-6 text-gray-200 cursor-pointer hover:text-red-500 flex"></XCircleIcon></a>
        </div>
        </div>
      </div>
      <Modal :task="task" :key="task.id" v-show="isModalVisible" @toggleModal="closeModal()"></Modal>
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
import Modal from '@/Components/Modal.vue';
import { ref, defineProps, onMounted, reactive, computed } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { router } from '@inertiajs/vue3';

export default {
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  components: {
    BookmarkSquareIcon,
    BriefcaseIcon,
    Button,
    Checkbox,
    Modal,
    Navbar,
    PrimaryButton,
    PencilSquareIcon,
    TaskField,
    XCircleIcon
},
  setup(props) {
    let activeTask = reactive(props.task);
    let checked = ref(false);
    let completedTasks = [];
    let isActive = ref(true);
    let isModalVisible = ref(false);
    let taskBody = '';
    let toggleTask = ref(false);
    let workTasks = ref([]);
    let value = null;


    // functions -- try moving these outside the setup function
    function archiveTask(task) {
      // consider using a Set, doesn't allow duplicate values
      let params = task;
      router.post('/ArchivedTask/Store', params);
    }
    function closeModal() {
      activeTask = null;
      this.isModalVisible = false;
    }
    function deleteTask(taskToDelete) {
      let workTasksD = this.workTasks;
      let params = {
        'task_id': taskToDelete.id
      };
      
      this.workTasks = workTasksD.filter(t => t.id != taskToDelete.id);
      router.post('/WorkChecklist/Delete',  params);
    }
    
    function saveTask(task) {
      let params = {
          task_body: task
      }
      Inertia.post('/WorkChecklist/Store', params);
    }

    function showModal(task) {
      activeTask = task;
      this.isModalVisible = true;
    }
    
    
    function toggleTaskField() {
      toggleTask.value = !toggleTask.value;
    }

    // figure out how to preserve scroll position when you toggle
    // task complete
    function toggleTaskComplete($event){
      activeTask.task_completed = $event;

      let params = activeTask;
      router.post('/WorkChecklist/Update' , params);
    }
    
    return {
      activeTask,
      archiveTask,
      checked,
      closeModal,
      completedTasks,
      deleteTask,
      isActive,
      isModalVisible,
      saveTask,
      showModal, 
      taskBody,
      toggleTask,
      toggleTaskField,
      toggleTaskComplete,
      workTasks,
      value
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