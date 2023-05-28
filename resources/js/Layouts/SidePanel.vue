<template>
  <div id="side-panel" class="bg-gray-50 space-y-12 border-r shadow-lg border-rose-50">
    <div class="flex flex-col ml-8 space-y-1">
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded">
        <!-- <InboxArrowDownIcon class="h-6 w-6 text-sky-400 opacity-50"></InboxArrowDownIcon> -->
        <!-- <InboxArrowDownIcon class="h-6 w-6 text-gray-600"></InboxArrowDownIcon> -->
        <span class="font-semibold text-gray-400">Inbox</span>
      </div>
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded">
        <!-- <CalendarDaysIcon class="h-6 w-6 text-gray-600"></CalendarDaysIcon> -->
        <span class="font-semibold text-gray-400">Today</span>
      </div>
      <div class="flex flex-row space-x-2 hover:bg-gray-300 px-2 py-1 mr-4 rounded items-center">
        <!-- <font-awesome-icon class="text-gray-500" icon="bell" /> -->
        <font-awesome-icon icon="fa-sharp fa-regular fa-bell" />
        <span class="font-semibold text-gray-400 border-b-2 border-rose-300">Upcoming</span>
      </div>
    </div>
    <div class="flex flex-col ml-12 space-y-3 font-medium">
      <div>
        <span class="text-gray-600 font-semibold">Projects</span>
      </div>
      <div class="flex flex-row space-x-2 ml-4">
        <!-- <BuildingOffice2Icon class="w-6 h-6"></BuildingOffice2Icon> -->
        <Link href="/WorkChecklist"><span class="font-semibold text-gray-600">Work</span></Link>
      </div>
      <div class="flex flex-row space-x-2 ml-4">
        <!-- <BuildingLibraryIcon class="w-6 h-6"></BuildingLibraryIcon> -->
        <Link href="/WorkChecklist"><span class="font-semibold text-gray-600">Education</span></Link>
      </div>
    </div>
  </div>
  <slot></slot>
</template>

<script setup>
import { InboxArrowDownIcon } from '@heroicons/vue/24/solid'
import { CalendarDaysIcon } from '@heroicons/vue/24/solid'
import { BuildingOffice2Icon } from '@heroicons/vue/24/solid'
import { BuildingLibraryIcon } from '@heroicons/vue/24/solid'
import { BellIcon } from '@heroicons/vue/24/solid'
import { Link } from '@inertiajs/vue3';
  // const test = "today"

</script>

<style>
  #side-panel {
    padding-top: 65px;
    min-height: 100vh;
    max-width: 200px;
  }

</style>