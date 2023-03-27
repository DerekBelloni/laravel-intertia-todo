<template v-if="">
  <form form @submit.prevent="saveTask()">
    <textarea v-model="task" class="rounded" rows="5" cols="60" placeholder="Create a task..."></textarea>
    <div class="flex justify-end">
      <Button>Submit</Button>
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