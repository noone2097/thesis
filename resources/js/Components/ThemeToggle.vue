<script setup>
import { ref, onMounted } from "vue";
import { Sun, Moon } from "lucide-vue-next";

const isDark = ref(false);

onMounted(() => {
  // Check initial theme
  isDark.value = document.documentElement.classList.contains("dark");

  // Watch for system theme changes
  window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", (e) => {
    isDark.value = e.matches;
    updateTheme();
  });
});

function toggleTheme() {
  isDark.value = !isDark.value;
  updateTheme();
}

function updateTheme() {
  // Add transition class before changing theme
  document.documentElement.classList.add('theme-transition');
  
  // Update root element class
  if (isDark.value) {
    document.documentElement.classList.add("dark");
  } else {
    document.documentElement.classList.remove("dark");
  }

  // Store preference
  localStorage.setItem("theme", isDark.value ? "dark" : "light");
  
  // Remove transition class after animation completes
  setTimeout(() => {
    document.documentElement.classList.remove('theme-transition');
  }, 200);
}
</script>

<template>
  <button
    @click="toggleTheme"
    class="inline-flex h-9 w-9 items-center justify-center rounded-md hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
  >
    <Sun v-if="!isDark" class="h-4 w-4 text-muted-foreground" />
    <Moon v-else class="h-4 w-4 text-muted-foreground" />
    <span class="sr-only">Toggle theme</span>
  </button>
</template>

<style>
.theme-transition,
.theme-transition *,
.theme-transition *::before,
.theme-transition *::after {
  transition: all 0.2s ease-in-out !important;
}
</style>
