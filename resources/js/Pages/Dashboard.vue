<template>
  <div class="bg-gray-100">
    <Navbar>
      <div class="container mx-auto">
        <div class="flex justify-center mt-20">
          <div class="flex flex-col">
            <font-awesome-icon icon="hat-wizard" />
            <span class="font-semibold text-gray-600 text-center">
              {{ datetime_pieces.day }}, {{ datetime_pieces.month }} {{ datetime_pieces.date }}
            </span>
            <span class="font-bold text-2xl text-gray-600 text-center">
              Good {{time_of_day}}, {{user.name}}!
            </span>
            <div class="grid grid-cols-2 mt-4 bg-gray-100 rounded-full shadow py-1 px-2 divide-x divide-gray-300 grow border border-rose-300">
              <div class="flex justify-center">
                <p class="font-bold text-gray-600">{{ incomplete_tasks }} tasks</p>
              </div>
              <div class="flex justify-center">
                <p class="font-bold text-gray-600">0 projects</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Navbar>
  </div>
</template>

<script >
import Navbar from '@/Layouts/Navbar.vue';

export default{
  props: {
    user: {
      type: Object,
      required: true
    },
    datetime_pieces: {
      type: Object,
      required: true
    },
    incomplete_tasks: {
      type: Number,
      required: true
    },
    time_of_day: {
      type: String,
      reuqired: true
    }
  },
  components: {
    Navbar
  },
  setup(props) {
    return {
      
    }
  }
}
</script>

<style>
  /* template {
    background-color: white;
  } */
</style>
