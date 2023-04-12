<template>
<div class="ml-6 space-y-4">
  <div class="flex flex-col border-t border-gray-200 py-2 px-2">
      <div>
        <div class="flex justify-start">
          <Checkbox :checked="activeTask.task_completed" :value="value"  @update:checked="toggleTaskComplete($event)"></Checkbox>
          <div class="ml-4">
            <span class="flex font-thin  decoration-zinc-400	text-sm" :class="activeTask.task_completed ? 'line-through' : ''">{{ activeTask.checklist_item_body }}</span>
          </div>
        </div>
      </div>
      <div class="flex items-baseline justify-between">
        <div class="mt-10">
          <span class="text-xs">{{ task.created_at }}</span>
        </div>
        <div class="flex justify-end mt-10 text-xs items-center space-x-2 pr-3 hover:bg-gray-300 hover:rounded hover:px-1 hover:py-1 hover:text-white">
          <label for="my-modal-5"><PencilSquareIcon class="h-6 w-6 hover:bg-gray-400 rounded px-1" @click="showModal(task)"></PencilSquareIcon></label>
          <a class="hover:bg-gray-400 px-1 rounded" :class="task.task_completed ? 'cursor-pointer font-medium' : 'cursor-pointer pr-2 font-medium'" @click="archiveTask(task)"><span >Archive Task</span></a>
          <div class="flex justify-end" v-if="task.task_completed">
          <a @click="deleteTask(task)"><XCircleIcon class="h-6 w-6 text-gray-200 cursor-pointer hover:text-red-500 flex" ></XCircleIcon></a>
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
    Navbar,
    PrimaryButton,
    TaskField,
    Checkbox,
    Button,
    BriefcaseIcon,
    XCircleIcon,
    PencilSquareIcon,
    BookmarkSquareIcon,
    Modal
},
  setup(props) {
    let toggleTask = ref(false);
    let checked = ref(false);
    let completedTasks = [];
    let workTasks = ref([]);
    let value = null;
    let taskBody = '';
    let isActive = ref(true);
    let isModalVisible = ref(false);
    let activeTask = reactive(props.task);


    // functions -- try moving these outside the setup function
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
      let params = task;
      router.post('/ArchivedTask/Store', params);
    }

    function saveTask(task) {
      console.log('save task coming from modal: ', task)
      let params = {
          task_body: task
      }
      Inertia.post('/WorkChecklist/Store', params);
    }

    function showModal(task) {
      activeTask = task;
      console.log('active task: ', activeTask);
      this.isModalVisible = true;
    }

    function closeModal() {
      activeTask = null;
      this.isModalVisible = false;
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
      saveTask,
      closeModal,
      showModal, 
      isModalVisible,
      activeTask
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