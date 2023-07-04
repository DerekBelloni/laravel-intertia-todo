<template>
  <div class="bg-gray-100">
    <Navbar @sidepanel:toggled="responsiveSidePanel($event)">
      <div :class="sidePanelActive ? 'side-panel' : ''">
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
                  <p class="font-bold text-gray-600">{{ projects.length}} project(s)</p>
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
                    <div class="ml-4 border-b border-gray-200 py-1 flex items-center justify-between">
                      <span class="text-gray-600 font-semibold truncate overflow-hidden">
                        {{ task.checklist_item_body }}
                      </span>
                      <font-awesome-icon @click="showModal(task)" class="mr-3 text-gray-500 hover:text-emerald-300" :icon="['far', 'circle-right']" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-start-7 col-span-5 mt-10 ml-2">
              <div class="bg-gray-50 rounded shadow border">
                <div class="flex flex-row justify-between items-center my-2 border-b pl-2 pb-2">
                  <span class="font-semibold text-gray-600 ml-4">Projects</span>
                  <a @click="toggleProjectInput()" class="mr-4 text-gray-400 hover:text-emerald-400 flex flex-row items-center">
                    <p class="font-semibold text-gray-600 pr-2">Add a project</p>
                    <font-awesome-icon :icon="['fas', 'circle-plus']" />
                  </a>
                </div>
                <div v-if="projects.length">
                  <div v-for="project in projects">
                    <div class="ml-4 border-b border-gray-200 py-1 flex items-center justify-between">
                      <span class="text-gray-600 font-semibold truncate overflow-hidden">
                        {{ project.project_name }}
                      </span>
                    </div>
                  </div>
                </div>
                <div v-else class="ml-4 text-center my-4">
                  <span class="text-gray-600 font-semibold">You currently have no projects. Get started!</span>
                </div>
                <div v-if="projectInput" class="flex flex-row ml-4 items-center border-b pb-2">
                  <p class="font-semibold text-sm text-gray-600 pr-2 ml-2">Project Name</p>
                  <form class="flex flex-grow" @submit.prevent="createProject()">
                    <input v-model="projectName" class="h-6 ml-4 w-3/4 rounded-xl border-gray-200 focus:border-gray-300 focus:ring-0 shadow-inner" type="text"/>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <Modal 
          v-if="isModalVisible && Object.keys(activeTask).length > 0" 
          :task="activeTask" 
          :user="user" 
          :datetime_pieces="datetime_pieces" 
          :projects="projects"
          v-show="isModalVisible"
          @toggleModal="closeModal()"
          @taskComplete="toggleTaskComplete(activeTask)"
          ></Modal>
        </div>
      </div>
    </Navbar>
  </div>
</template>

<script >
import Modal from '@/Components/Modal.vue';
import Navbar from '@/Layouts/Navbar.vue';
import { ref, onMounted, reactive, watch } from 'vue';
import useSaveTask from "@/Composables/useSaveTask";
import { Inertia } from "@inertiajs/inertia";
import { router } from '@inertiajs/vue3';
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
    projects: {
      type: Array,
      required: false
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
    Navbar,
    Modal
  },
  setup(props) {
    let activeTasks = reactive(props.tasks);
    let activeTask = ref({
      id: 0,
      user_id: 0,
      checklist_title: null,
      checklist_item_body: null,
      task_completed: false,
      due_date: null
    });
    let isModalVisible = ref(false);
    let projectInput = ref(false);
    let projectName = ref("");
    let sidePanelActive = ref(false);
    let taskBody = ref('');
    let url = "/Checklist/Store";

    function closeModal() {
      activeTask.id = 0;
      activeTask.user_id = 0;
      activeTask.checklist_title = null;
      activeTask.checklist_item_body = null;
      isModalVisible.value = false;
    }

    function createProject() {
      let params = {
        projectName: projectName.value
      }
      router.post('/Project/Store', params);
      projectName.value = '';
    }

    function handleEmit($event) {
      console.log('event: ', $event)
    }

    function handleSaveTask() {
      let task_body = taskBody.value;
      saveTask(url, task_body, {parent_task_id: null, subtask_type: null});
    }

    
    function responsiveSidePanel($event) {
      sidePanelActive.value = $event;
    }
    
    function showModal(task) {
      activeTask.value.id = task.id;
      activeTask.value.user_id = task.user_id;
      activeTask.value.checklist_title = task.checklist_title;
      activeTask.value.checklist_item_body = task.checklist_item_body;
      activeTask.value.task_completed = task.task_completed;
      activeTask.value.due_date = task.due_date
      isModalVisible.value = true;
    }
    
    function toggleProjectInput() {
      projectInput.value = !projectInput.value;
    }

    function toggleTaskComplete(activeTask) {
      activeTask.task_completed = !activeTask.task_completed;
      let params = activeTask;

      router.post('/Checklist/Update' , params);
      Inertia.reload();
    }

    return {
      activeTask,
      activeTasks,
      closeModal,
      createProject,
      handleSaveTask,
      handleEmit,
      isModalVisible,
      projectInput,
      projectName, 
      responsiveSidePanel,
      sidePanelActive,
      showModal,
      taskBody,
      toggleProjectInput,
      toggleTaskComplete
    }
  }
}
</script>

<style>
  .side-panel {
    margin-left: 200px;
    /* transition: margin-left 0.25s; */
  }
</style>
