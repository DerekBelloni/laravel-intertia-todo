<template>
   <!-- <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 sidebar"> -->
   <div class="flex flex-col gap-y-5 border-r border-gray-200 bg-white px-6 sidebar">
     <nav class="flex flex-1 flex-col  mt-8">
       <ul role="list" class="flex flex-1 flex-col gap-y-7">
         <li>
           <ul role="list" class="-mx-2 space-y-1">
             <li v-for="item in navigation" :key="item.name">
               <a v-if="!item.children" :href="item.href" :class="[item.current ? 'bg-gray-100' : 'hover:bg-gray-100', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-700']">
                 <component :is="item.icon" class="h-6 w-6 shrink-0 text-gray-400" aria-hidden="true" />
                 {{ item.name }}
               </a>
               <Disclosure as="div" v-else v-slot="{ open }">
                 <DisclosureButton :class="[item.current ? 'bg-gray-100' : 'hover:bg-gray-100', 'flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-gray-700']">
                   <component :is="item.icon" class="h-6 w-6 shrink-0 text-gray-400" aria-hidden="true" />
                   {{ item.name }}
                   <ChevronRightIcon :class="[open ? 'rotate-90 text-gray-500' : 'text-gray-400', 'ml-auto h-5 w-5 shrink-0']" aria-hidden="true" />
                 </DisclosureButton>
                 <DisclosurePanel as="ul" class="mt-1 px-2">
                   <li v-for="subItem in item.children" :key="subItem.name">
                     <!-- 44px -->
                     <DisclosureButton as="a" :href="subItem.href" :class="[subItem.current ? 'bg-gray-50' : 'hover:bg-gray-50', 'block rounded-md py-2 pr-2 pl-9 text-sm leading-6 text-gray-700']">{{ subItem.name }}</DisclosureButton>
                   </li>
                 </DisclosurePanel>
               </Disclosure>
             </li>
           </ul>
         </li>
         <!-- <li class="-mx-6 mt-auto">
           <a href="#" class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-100">
             <span class="sr-only">Your profile</span>
             <span aria-hidden="true">Derek Belloni</span>
           </a>
         </li> -->
       </ul>
     </nav>
   </div>
<slot></slot>
 </template>
 
 <script setup>
 import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
 import { ChevronRightIcon } from '@heroicons/vue/20/solid'
 import {
   CalendarIcon,
   ChartPieIcon,
   DocumentDuplicateIcon,
   FolderIcon,
   HomeIcon,
   RectangleStackIcon,
   UsersIcon,
 } from '@heroicons/vue/24/outline'
 
 const navigation = [
   { name: 'Dashboard', href: '/Dashboard', icon: HomeIcon, current: true },
   { name: 'Tasks', href: '/Checklist', icon: RectangleStackIcon, current: true},
   {
     name: 'Projects',
     icon: FolderIcon,
     current: false,
     children: [
       { name: 'GraphQL API', href: '#' },
       { name: 'iOS App', href: '#' },
       { name: 'Android App', href: '#' },
       { name: 'New Customer Portal', href: '#' },
     ],
   },
   {
     name: 'Teams',
     icon: UsersIcon,
     current: false,
     children: [
       { name: 'Engineering', href: '#' },
       { name: 'Human Resources', href: '#' },
       { name: 'Customer Success', href: '#' },
     ],
   },
   { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
   { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
   { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
 ]
 </script>

 <style>
   .sidebar {
      width: 15%;
      height: 100vh;
   }
</style>