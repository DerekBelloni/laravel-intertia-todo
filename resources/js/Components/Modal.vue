<template>
  <div class="modal-backdrop">
    <div id="modal-body" class="rounded-xl max-w-4xl">
      <header class="border border-gray-200 border-b h-14 modal-header">
        <slot name="header">
          <div class="flex justify-end">
            <button @click="$emit('toggleModal')">
              <XMarkIcon class="h-5 w-5 text-gray-300 hover:bg-gray-200 hover:text-white rounded-full hover:shadow-xl"></XMarkIcon>
            </button>
          </div>
        </slot>
      </header>

      <section class="mt-10">
        <slot name="body">
          <!--Grid-->
          <div class="grid grid-cols-12">
            <div class=" mt-2 ml-12 mr-10 pb-2 col-span-8 ">
              <div class="flex flex-row items-center">
                <Checkbox :checked="activeTask.task_completed" class="h-4 w-4" @update:checked="toggleTaskComplete($event)"></Checkbox>
                <div class="ml-6">
                  <span class="text-xl font-thin" :class="activeTask.task_completed ? 'line-through' : ''">{{ activeTask.checklist_title }}</span>
                </div>
              </div>
              <div class="mt-2 ml-10 text-gray-400 text-md font-thin"  :class="activeTask.task_completed ? 'line-through' : ''">
                <span>{{ activeTask.checklist_item_body }}</span>
              </div>
              <div class="ml-12 text-sm font-medium">
                <ul v-for="subTask in activeTask.sub_tasks">
                  <div class="flex flex-row items-center justify-between">
                    <div class="flex items-center">
                      <SmallCheckbox :checked="subTask.subtask_completed" @update:small-checked="toggleSubTaskComplete($event, subTask)"></SmallCheckbox>
                      <li class="pl-2" :class="subTask.subtask_completed ? 'line-through' : ''">{{ subTask.subtask_body }}</li>
                    </div>
                    <div>
                      <XCircleIcon class="h-3 w-3 hover:text-red-500" @click="deleteSubTask(subTask)"></XCircleIcon>
                    </div>
                  </div>
                </ul>
              </div>
              <div class="mt-4 text-xs ml-10 text-gray-500 font-medium">
                <a class="cursor-pointer hover:bg-gray-300 rounded px-2 py-1" @click="toggleSubTaskField($event)"><span>+ Add sub-task</span></a>
              </div>
              <div v-if="toggleSubTask == true" class="mt-2 mx-10" >
                <TaskField @saveTask="saveTask"></TaskField>
              </div>
            </div>
          </div>
        </slot>
      </section>

      <footer class="modal-footer flex justify-end mr-6">
        <slot name="footer">
        </slot>
      </footer>
    </div>
  </div>
</template>

<script>
import { XMarkIcon, xMarkIcon } from '@heroicons/vue/24/solid';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import Checkbox from '@/Components/Checkbox.vue';
import SmallCheckbox from '@/Components/SmallCheckbox.vue';
import TaskField from '@/Components/TaskField.vue';
import {reactive, onMounted, toRefs, ref} from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { router } from '@inertiajs/vue3';
export default {
  props: {
    isModalVisible: {
      type: Boolean,
      required: false
    },
    task: {
      type: Object,
      required: false
    }
  },
  components: {
    xMarkIcon,
    XMarkIcon,
    Checkbox,
    TaskField,
    SmallCheckbox,
    XCircleIcon
},
  setup(props) {
    let activeTask = reactive(props.task);
    let toggleSubTask = ref(false);

    function deleteSubTask(subTask) {
      let sub_tasks = activeTask.sub_tasks;

      activeTask.sub_tasks.splice(activeTask.sub_tasks.findIndex((sub_task) => {
        sub_task.id === subTask.id
      }))

      let params = {
        'subtask_id': subTask.id
      }

      router.post('/Subtask/Delete',  params);
    }

    function saveTask(taskBody) {
      let params = {
          parent_task_id: activeTask.id,
          task_body: taskBody,
          subtask_type: 'work'
      }
      Inertia.post('/Subtask/Store', params);
    }

    function toggleSubTaskField() {
      toggleSubTask.value = !toggleSubTask.value;
    }

    function toggleSubTaskComplete($event, subTask) {
      subTask.task_completed = $event;
      let sub_tasks = activeTask.sub_tasks;

      sub_tasks.forEach((sub_task) => {
        if (sub_task.id === subTask.id) {
          sub_task.subtask_completed = $event;
          return;
        }
      })

      let params = subTask
      router.post('/Subtask/Update', params);
    }

    function toggleTaskComplete($event) {
      activeTask.task_completed = $event;

      let params = activeTask;
      router.post('/WorkChecklist/Update' , params);
    }

    return {
      activeTask,
      toggleSubTaskField,
      toggleSubTask,
      toggleTaskComplete,
      saveTask,
      toggleSubTaskComplete,
      deleteSubTask
    }
  }
  
}
</script>

<style>
  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #modal-body {
    background: #FFFFFF;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    min-height: 625px;
    min-width: 890px;
  }

  .modal-header,
  .modal-footer {
    padding: 15px;
    /* display: flex; */
  }
  
  .btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
  }
</style>