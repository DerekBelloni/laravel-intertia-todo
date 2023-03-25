<template>
  <div id="side-panel" class="bg-gray-50 space-y-12">
    <div class="flex flex-col ml-8 space-y-3">
      <div class="flex flex-row space-x-2">
        <InboxArrowDownIcon class="h-6 w-6"></InboxArrowDownIcon>
        <span class="font-semibold">Inbox</span>
      </div>
      <div class="flex flex-row space-x-2">
        <CalendarDaysIcon class="h-6 w-6"></CalendarDaysIcon>
        <span class="font-semibold">Today</span>
      </div>
      <span class="font-semibold">Upcoming</span>
    </div>
    <div class="flex flex-col ml-8 space-y-3 font-semibold">
      <div class="flex flex-row space-x-2">
        <BuildingOffice2Icon class="w-6 h-6"></BuildingOffice2Icon>
        <Link href="/WorkChecklist">Work</Link>
      </div>
      <div class="flex flex-row space-x-2">
        <BuildingLibraryIcon class="w-6 h-6"></BuildingLibraryIcon>
        <Link href="/WorkChecklist">Education</Link>
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