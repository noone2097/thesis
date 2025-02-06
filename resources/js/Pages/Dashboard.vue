<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Shield, Mail, User } from "lucide-vue-next";

defineProps({
  auth: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Head title="Dashboard" />

  <DashboardLayout>
    <div class="space-y-4">
      <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
      <div class="grid gap-4 md:grid-cols-2">
        <!-- User Profile Card -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
          <div class="p-6">
            <h3 class="text-lg font-medium mb-4">Your Profile</h3>
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <User class="h-5 w-5 text-muted-foreground" />
                <span class="text-muted-foreground">{{ auth.user.name }}</span>
              </div>
              <div class="flex items-center gap-3">
                <Mail class="h-5 w-5 text-muted-foreground" />
                <span class="text-muted-foreground">{{ auth.user.email }}</span>
              </div>
              <div class="flex items-center gap-3">
                <Shield class="h-5 w-5 text-muted-foreground" />
                <div class="flex flex-wrap gap-1.5">
                  <div
                    v-if="auth.user.is_admin"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400 border border-purple-100 dark:border-purple-500/20"
                  >
                    Admin
                  </div>
                  <div
                    v-if="!auth.user.is_admin"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-gray-50 text-gray-700 dark:bg-gray-500/10 dark:text-gray-400 border border-gray-100 dark:border-gray-500/20"
                  >
                    User
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Welcome Card -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
          <div class="p-6">
            <h3 class="text-lg font-medium">Welcome to your dashboard!</h3>
            <p class="text-muted-foreground mt-2">
              You're successfully logged in to the system.
            </p>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
