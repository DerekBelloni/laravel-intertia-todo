<template>
  <div id="navbar" class="bg-teal-300">
    <div class="ml-4 pb-2 pt-4 flex flex-row space-x-2 items-center">
      <FireIcon class="w-6 h-6 text-white"></FireIcon>
      <Bars3Icon class="h-6 w-6 text-white cursor-pointer"></Bars3Icon>
      <div class="mr-6">
        <input id="custom-searchbar" placeholder="Search..." class="rounded h-6 palceholder:text-white  focus:ring-teal-200" type="search">
      </div>
  
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
  import { Bars3Icon } from '@heroicons/vue/24/solid';
  import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';

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

  #custom-searchbar {
    border: none;
    background-color: rgba(193, 215, 226, 0.638);
    width: 120px;
    margin-right: 35px;
  }
</style>