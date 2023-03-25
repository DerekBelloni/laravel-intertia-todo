<template>
  <Navbar>
    <div>
      <div class="grid grid-cols-8">
        <div class="col-start-3">
          <div class="flex mt-8 text-lg px-2">
            <span class="font-semibold">Work</span>
            <button class="rounded bg-teal-600 text-white mx-4 " size="sm" @click="toggleTaskField()">Add Task</button>
          </div>
        </div>
      </div>
    </div>
  </Navbar>
</template>

<script setup>
import Navbar from '@/Layouts/Navbar.vue';
import { ref } from 'vue';

//variables
let toggleTask = ref(false);

// functions
function toggleTaskField() {
  toggleTask = true;
}
</script>