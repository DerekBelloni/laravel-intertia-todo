<template>
  <form form @submit.prevent="saveTask()" class="mb-12">
    <div class="grid grid-cols-8">
      <div class="grid col-span-8">
        <textarea v-model="task"  class="textarea focus:ring-teal-200 border border-gray-200 bg-white" rows="5" cols="55" placeholder="Create a task..." ></textarea>
        <div class="flex justify-end ml-3 mt-4">
          <!-- <Button>Submit</Button> -->
          <a @click.prevent="saveTask()"><label class="btn btn-outline btn-ghost btn-xs">Submit</label></a>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import Button from "@/Components/Button.vue";

let task = '';

function saveTask() {
  let params = {
      task_body: task
  }

  Inertia.post('/WorkChecklist/Store', params);
}
</script>