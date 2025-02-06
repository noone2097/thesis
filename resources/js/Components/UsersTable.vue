<script setup>
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/Components/ui/table";
import { Avatar, AvatarImage, AvatarFallback } from "@/Components/ui/avatar";
import { CheckCircle, XCircle, Shield } from "lucide-vue-next";

const props = defineProps({
  users: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div
    class="relative rounded-xl border border-border bg-card text-card-foreground shadow-sm"
  >
    <div class="overflow-hidden">
      <Table>
        <TableHeader>
          <TableRow class="border-b border-border bg-muted/50">
            <TableHead class="w-12 py-4"></TableHead>
            <TableHead class="py-4 font-semibold">Name</TableHead>
            <TableHead class="py-4 font-semibold">Email</TableHead>
            <TableHead class="py-4 font-semibold">Access Level</TableHead>
            <TableHead class="py-4 font-semibold">Email Verified</TableHead>
            <TableHead class="py-4 font-semibold">Created At</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow
            v-for="(user, index) in users"
            :key="user.id"
            class="border-b border-border transition-colors hover:bg-muted/50"
            :class="{ 'bg-muted/30': index % 2 === 0 }"
          >
            <TableCell class="py-4">
              <Avatar class="h-10 w-10 border-2 border-primary/10">
                <AvatarFallback class="bg-primary/10 text-primary-foreground font-medium">
                  {{ user.name.charAt(0).toUpperCase() }}
                </AvatarFallback>
              </Avatar>
            </TableCell>
            <TableCell class="py-4">
              <div class="font-medium text-foreground">{{ user.name }}</div>
            </TableCell>
            <TableCell class="py-4">
              <div class="text-muted-foreground">{{ user.email }}</div>
            </TableCell>
            <TableCell class="py-4">
              <div class="flex flex-wrap gap-1.5">
                <div
                  v-if="user.is_admin"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400 border border-purple-100 dark:border-purple-500/20"
                >
                  <Shield class="h-3.5 w-3.5 mr-1" />
                  Admin
                </div>
                <div
                  v-else
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-gray-50 text-gray-700 dark:bg-gray-500/10 dark:text-gray-400 border border-gray-100 dark:border-gray-500/20"
                >
                  <Shield class="h-3.5 w-3.5 mr-1" />
                  User
                </div>
              </div>
            </TableCell>
            <TableCell class="py-4">
              <div
                v-if="user.email_verified_at !== null"
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400 border border-green-100 dark:border-green-500/20"
              >
                <CheckCircle class="h-4 w-4 mr-1" />
                Verified
              </div>
              <div
                v-else
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-100 dark:border-red-500/20"
              >
                <XCircle class="h-4 w-4 mr-1" />
                Unverified
              </div>
            </TableCell>
            <TableCell class="py-4">
              <div class="text-muted-foreground text-sm">
                {{
                  new Date(user.created_at).toLocaleDateString("en-US", {
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                  })
                }}
              </div>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>

<style scoped>
.table-row-fade-enter-active,
.table-row-fade-leave-active {
  transition: all 0.25s ease;
}

.table-row-fade-enter-from,
.table-row-fade-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}
</style>
