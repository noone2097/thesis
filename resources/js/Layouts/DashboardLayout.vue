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
      class="fixed top-0 right-0 h-screen overflow-y-auto bg-default text-default transition-all duration-300 ease-in-out"
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

<style>
:root {
  /* Light mode */
  --text-primary: theme('colors.gray.900');
  --text-secondary: theme('colors.gray.700');
  --text-muted: theme('colors.gray.600');
  --bg-primary: theme('colors.white');
  --bg-secondary: theme('colors.gray.50');
  --bg-muted: theme('colors.gray.100');
  --border-color: theme('colors.gray.200');
}

:root.dark {
  /* Dark mode */
  --text-primary: theme('colors.gray.100');
  --text-secondary: theme('colors.gray.300');
  --text-muted: theme('colors.gray.400');
  --bg-primary: theme('colors.gray.900');
  --bg-secondary: theme('colors.gray.800');
  --bg-muted: theme('colors.gray.700');
  --border-color: theme('colors.gray.700');
}

.theme-transition {
  transition: all 0.2s ease-in-out;
}

/* Universal text styles */
.text-default {
  @apply text-gray-900 dark:text-gray-100;
}

.text-secondary {
  @apply text-gray-700 dark:text-gray-300;
}

.text-muted {
  @apply text-gray-600 dark:text-gray-400;
}

/* Universal background styles */
.bg-default {
  @apply bg-white dark:bg-gray-900;
}

.bg-secondary {
  @apply bg-gray-50 dark:bg-gray-800;
}

.bg-muted {
  @apply bg-gray-100 dark:bg-gray-700;
}
</style>
