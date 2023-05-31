<template>
    <div class="modal-backdrop">
      <div id="modal-body" class="rounded max-w-xl bg-gray-100">
        <header class="modal-header">
          <slot name="header">
            <div class="border-b py-2 px-2 flex items-center justify-between my-1">
              <div>
                <button class="ml-6 rounded px-2 py-1 text-gray-400 hover:border-emerald-500 hover:border-2 hover:bg-emerald-400 border hover:opacity-50 hover:text-emerald-100 text-xs">Mark Complete</button>
              </div>
              <div class="flex justify-end">
                <button @click="$emit('toggleModal')">
                  <font-awesome-icon class="text-gray-300 hover:text-rose-500" :icon="['fasr', 'circle-xmark']" />
                </button>
              </div>
            </div>
          </slot>
        </header>
  
        <section class="mt-4" id="main-content">
          <slot name="body">
            <!--Grid-->
            <div class="grid grid-cols-12">
              <div class=" mt-2 ml-6 mr-10 pb-2 col-span-12">
                <div class="flex flex-row items-center">
                </div>
                <div class="text-gray-400 text-xl font-semibold"  :class="activeTask.task_completed ? 'line-through text-gray-400' : ''">
                  <span>{{ activeTask.checklist_item_body }}</span>
                </div>
                <div class="ml-12">
                  <ul v-for="subTask in activeTask.sub_tasks">
                    <div class="flex flex-row items-center justify-between">
                      <div class="flex items-center">
                        <SmallCheckbox :checked="subTask.subtask_completed" @update:small-checked="toggleSubTaskComplete($event, subTask)"></SmallCheckbox>
                        <li class="pl-2 text-gray-400" :class="subTask.subtask_completed ? 'line-through' : ''">{{ subTask.subtask_body }}</li>
                      </div>
                      <div>
                        <XCircleIcon v-if="subTask.subtask_completed" class="h-3 w-3 text-gray-400 hover:text-red-500" @click="deleteSubTask(subTask)"></XCircleIcon>
                      </div>
                    </div>
                  </ul>
                </div>
                <div class="mt-4 text-xs ml-10 text-gray-400 font-medium">
                  <a class="cursor-pointer hover:bg-gray-300 hover:text-white rounded px-2 py-1" @click="toggleSubTaskField($event)"><span>+ Add sub-task</span></a>
                </div>
                <div v-if="toggleSubTask == true" class="mt-2 mx-10" >
                  <TaskField @saveTask="handleSaveTask"></TaskField>
                </div>
              </div>
            </div>
            
            <!-- <div class="grid grid-cols-10 border-t mt-16">
              <div class="col-span-8">
                  <div class="flex justify-center">
                    <textarea v-model="newComment" class="rounded-xl border border-gray-200 focus:ring-teal-200 shadow-sm text-xs text-gray-400"></textarea>
                    <div class="flex justify-end">
                      <button @click="saveComment()" class="text-xs text-gray-400 mr-2 mt-2 hover:bg-gray-300 hover:rounded-full hover:text-gray-100 hover:p-1">Submit</button>
                    </div>
                    <div class="flex flex-col space-y-2">
                    <template v-for="comment in activeTask.comments">
                      <span class="flex justify-center text-gray-400 mt-2 ml-6 rounded-xl bg-white shadow-inner p-2">{{ comment.comment_body }}</span>
                    </template>
                  </div>
              </div>
              </div>
            </div> -->
          </slot>
        </section>
          <slot>
          </slot>
      </div>
    </div>
  </template>
  
  <script>
  import { XMarkIcon, xMarkIcon } from '@heroicons/vue/24/solid';
  import { XCircleIcon } from '@heroicons/vue/24/solid';
  import Checkbox from '@/Components/Checkbox.vue';
  import SmallCheckbox from '@/Components/SmallCheckbox.vue';
  import TaskField from '@/Components/TaskField.vue';
  import {reactive, onMounted, toRefs, ref, computed, watchEffect, watch, onUpdated} from 'vue';
  import { Inertia } from "@inertiajs/inertia";
  import { router } from '@inertiajs/vue3';
  import useSaveTask from "@/Composables/useSaveTask";
  
  export default {
    props: {
      isModalVisible: {
        type: Boolean,
        required: false
      },
      task: {
        type: Object,
        required: false,
        default: () => ({}) 
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
      let newComment = ref('');
      let toggleSubTask = ref(false);
      let url = '/Subtask/Store';
      const { saveTask } = useSaveTask();


      function deleteSubTask(subTask) {
        activeTask.sub_tasks.splice(activeTask.sub_tasks.findIndex((sub_task) => {
          sub_task.id === subTask.id
        }))
  
        let params = {
          'subtask_id': subTask.id
        }
  
        router.post('/Subtask/Delete',  params);
      }
  
      function handleSaveTask(taskBody) {
        saveTask(url, taskBody, {parent_task_id: activeTask.id, subtask_type: 'work'});
      }

      function saveComment() {
        let params = {
          "comment_body": newComment.value,
          "parent_task_id": activeTask.id
        }
        router.post('/Comments/Store', params);
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
        deleteSubTask,
        handleSaveTask,
        newComment,
        saveTask,
        saveComment,
        toggleSubTaskField,
        toggleSubTask,
        toggleTaskComplete,
        toggleSubTaskComplete,
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
      height: 70%;
      min-width: 700px;
    }

    #bottom {
      position: absolute;
      align-items: bottom;
    }

    #main-content {
      height: 65%;
    }

  </style>