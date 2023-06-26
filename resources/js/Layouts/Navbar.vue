<template>
  <div class="bg-white min-h-screen fixed top-0 z-50 w-full">
  <div id="navbar" class="bg-rose-600">
    <div class="ml-4 pb-2 pt-4 flex flex-row space-x-2 items-center">
      <FireIcon class="w-6 h-6 text-white"></FireIcon>
      <a @click="toggleSidePanel()"><Bars3Icon class="h-6 w-6 text-white cursor-pointer"></Bars3Icon></a>
      <div class="mr-6">
        <input id="custom-searchbar" placeholder="Search..." class="rounded h-6 text-white placeholder:text-white  focus:ring-rose-200" type="search">
      </div>
  
     <div class="flex space-x-8">
        <Link href="/Dashboard" class="font-semibold text-white">Home</Link>
        <!-- <Link href="/" class="font-semibold text-white">About</Link> -->
        <Link href="/ArchivedTask" class="font-semibold text-white">Archive</Link>
     </div>
    </div>
      <SidePanel v-if="toggled"></SidePanel>
  </div>
  <slot></slot>
</div>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3'
  import SidePanel from '@/Layouts/SidePanel.vue';
  import SidePanelTwo from '@/Layouts/SidePanelTwo.vue';
  import { FireIcon } from '@heroicons/vue/24/solid';
  import { Bars3Icon } from '@heroicons/vue/24/solid';
  import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';
  import {ref, watch} from 'vue';

  export default {
    props: {
      tasks: {
        type: Array
      }
    },
    components: {
      Link,
      SidePanel,
      FireIcon,
      Bars3Icon,
      MagnifyingGlassIcon,
    },
    emits: ["sidepanel:toggled"],
    setup(props, context) {
      let toggled = ref(false);

      watch(toggled, (newToggle) => {
        context.emit('sidepanel:toggled', newToggle);
      })

      function toggleSidePanel() {
        toggled.value = !toggled.value;
      }

      return {
        Link,
        SidePanel,
        FireIcon,
        Bars3Icon,
        MagnifyingGlassIcon,
        toggleSidePanel,
        toggled
      }
    }
  }
</script>

<style>
  #navbar {
    height: 48px;
    opacity: .75;
  }

  #custom-searchbar {
    border: none;
    background-color: rgba(193, 215, 226, 0.638);
    width: 120px;
    margin-right: 35px;
  }
</style>