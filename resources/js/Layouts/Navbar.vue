<template>
  <div id="navbar" class="bg-teal-300">
    <div class="mx-4 pb-2 pt-4 flex flex-row space-x-12 items-center">
      <FireIcon class="w-6 h-6 text-white"></FireIcon>
     <span class="font-semibold text-white text-lg">Laravel Inertia Todo</span>
     
     <div class="flex space-x-8">
        <Link href="/" class="font-semibold text-white">Home</Link>
        <Link href="/" class="font-semibold text-white">About</Link>
        <Link href="/" class="font-semibold text-white">Archive</Link>
     </div>
    </div>
    <SidePanel></SidePanel>
  </div>
  <slot></slot>
</template>

<script setup>
  import { Link } from '@inertiajs/inertia-vue3'
  import SidePanel from '@/Layouts/SidePanel.vue';
  import { FireIcon } from '@heroicons/vue/24/solid';

  defineProps({
  tasks: {
    type: Array
  }
});
</script>

<style>
  #navbar {
    height: 52px;
  }
</style>