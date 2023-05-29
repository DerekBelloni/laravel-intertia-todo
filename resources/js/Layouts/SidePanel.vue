<template>
  <div id="side-panel" class="bg-gray-50 space-y-4 border-r shadow-lg border-rose-50">
    <div class="flex flex-col ml-8 space-y-1">
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded items-center">
        <font-awesome-icon class="text-sky-500" :icon="['fasr', 'inbox']" />
        <span class="font-semibold text-gray-400">Inbox</span>
      </div>
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded items-center">
        <font-awesome-icon class="text-emerald-500" :icon="['far', 'calendar-days']" />
        <span class="font-semibold text-gray-400">Today</span>
      </div>
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded items-center">
        <font-awesome-icon class="text-amber-500"  :icon="['far', 'bell']" />        
        <span class="font-semibold text-gray-400">Upcoming</span>
      </div>
    </div>
    <div class="flex flex-col ml-12 space-y-3 font-medium">
      <div>
        <span class="text-gray-600 font-semibold">Projects</span>
      </div>
      <div class="flex flex-row space-x-2 ml-4">
        <Link href="/WorkChecklist"><span class="font-semibold text-gray-600">Work</span></Link>
      </div>
      <div class="flex flex-row space-x-2 ml-4">
        <Link href="/WorkChecklist"><span class="font-semibold text-gray-600">Education</span></Link>
      </div>
    </div>
  </div>
  <slot></slot>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';

</script>

<style>
  #side-panel {
    padding-top: 65px;
    min-height: 100vh;
    max-width: 200px;
  }

</style>