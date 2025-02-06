<script setup>
import { ref, computed, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import Sidebar from "@/Components/Navigation/Sidebar.vue";

const sidebarRef = ref(null);
const isCollapsed = ref(false);

const sidebarWidth = computed(() => {
  return isCollapsed.value ? '80px' : '280px';
});

onMounted(() => {
  if (sidebarRef.value) {
    isCollapsed.value = sidebarRef.value.isCollapsed;
  }
});
</script>

<template>
  <div class="min-h-screen relative">
    <Sidebar ref="sidebarRef" @update:collapsed="isCollapsed = $event" />

    <!-- Main Content -->
    <main
      class="fixed top-0 right-0 h-screen overflow-y-auto bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-all duration-200"
      :style="{
        left: sidebarWidth,
        width: `calc(100% - ${sidebarWidth})`
      }"
    >
      <!-- Page Content -->
      <div class="p-6">
        <Head>
          <title>Dashboard - CoreScore</title>
        </Head>
        <slot />
      </div>
    </main>
  </div>
</template>
