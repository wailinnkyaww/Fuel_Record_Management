<script setup>
import Sidebar from '../components/SidebarLayout.vue'
import Navbar from '../components/NavbarLayout.vue'
</script>

<template>
  <div class="flex">
    <Sidebar />

    <div class="flex-1">
      <Navbar />

      <div class="p-6">
        <slot />
      </div>
    </div>
  </div>
</template>