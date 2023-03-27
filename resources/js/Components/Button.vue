<template>
    <button class="flex justify-center rounded p-1">
      <slot></slot>
    </button>
</template>

<script setup></script>

<style scoped>
  button {
    
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border: none;
                background-color: #27c4afb9;
                color: white;
                font-weight: 400;
                font-size: 16px;
                box-shadow: 0 4px 14px 0 rgba(27, 136, 103, 0.442);
                transition: background 0.2s ease,color 0.2s ease,box-shadow 0.2s ease;       
  }
</style>