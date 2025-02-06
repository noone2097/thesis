<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarGroupLabel,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarMenuSub,
  SidebarMenuSubButton,
  SidebarMenuSubItem,
  SidebarProvider,
} from "@/Components/ui/sidebar";

import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from "@/Components/ui/collapsible";

import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";

import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import ThemeToggle from "@/Components/ThemeToggle.vue";
import CollapseIcon from "@/Components/Icons/CollapseIcon.vue";

import {
  ChevronsUpDown,
  LogOut,
  User,
  LayoutDashboard,
  Users,
  Shield,
  Menu,
  X,
} from "lucide-vue-next";

import { ref } from "vue";

const isCollapsed = ref(false);

const emit = defineEmits(["update:collapsed"]);

const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value;
  emit("update:collapsed", isCollapsed.value);
};

const page = usePage();

const isActive = (path) => {
  return page.url.startsWith(path);
};

const navigationItems = [
  {
    title: "Dashboard",
    href: "/dashboard",
    icon: LayoutDashboard,
  },
  {
    title: "Admin Accounts",
    href: "/admin/users",
    icon: Users,
  },
];

const { auth } = usePage().props;
const user = auth.user;

defineExpose({ isCollapsed });
</script>

<template>
  <SidebarProvider>
    <Sidebar
      :class="[
        { 'w-[80px]': isCollapsed, 'w-[280px]': !isCollapsed },
        '[&_[data-sidebar]]:!w-full [&_[data-sidebar]]:!left-0',
      ]"
      class="fixed top-0 left-0 h-screen z-20 transition-all duration-300 ease-in-out bg-white dark:bg-gray-900 border-r dark:border-gray-800"
    >
      <SidebarHeader>
        <!-- Top buttons row -->
        <div class="relative h-[52px]">
          <div
            class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-between w-[calc(100%-32px)]"
          >
            <button
              @click="toggleSidebar"
              class="text-gray-700 dark:text-gray-200 hover:text-primary flex items-center justify-center h-7 w-7"
            >
              <CollapseIcon
                class="h-5 w-5 transition-transform duration-200"
                :class="{ 'rotate-180': isCollapsed }"
              />
            </button>
            <ThemeToggle v-if="!isCollapsed" />
          </div>
        </div>

        <!-- Logo and title -->
        <SidebarMenu class="mt-2">
          <SidebarMenuItem>
            <SidebarMenuButton
              size="lg"
              class="h-[52px]"
              :class="{
                '!justify-center': isCollapsed,
                '!justify-start pl-4': !isCollapsed,
              }"
            >
              <div
                class="flex items-center gap-3"
                :class="{ 'justify-center': isCollapsed }"
              >
                <img
                  src="/images/bisu_logo.png"
                  alt="BISU Logo"
                  class="h-7 w-7 shrink-0"
                />
                <div
                  v-if="!isCollapsed"
                  class="grid flex-1 text-left text-sm leading-tight"
                >
                  <span class="truncate font-semibold text-gray-900 dark:text-white"
                    >CoreScore</span
                  >
                  <span class="truncate text-xs text-gray-600 dark:text-gray-300"
                    >Admin Panel</span
                  >
                </div>
              </div>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>

      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel
            v-if="!isCollapsed"
            class="px-4 text-gray-600 dark:text-gray-400"
            >Navigation</SidebarGroupLabel
          >
          <SidebarMenu>
            <div v-for="item in navigationItems" :key="item.title" class="w-full">
              <SidebarMenuItem>
                <Link
                  :href="item.href"
                  class="w-full"
                  @click.prevent="$inertia.visit(item.href, { preserveState: true })"
                >
                  <SidebarMenuButton
                    :class="{
                      '!justify-center': isCollapsed,
                      '!justify-start pl-[1.15rem]': !isCollapsed,
                      'bg-primary/10 text-primary sidebar-button active': isActive(
                        item.href
                      ),
                      'sidebar-button': true,
                      'h-10 w-10 rounded-lg': isCollapsed && isActive(item.href),
                      'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white': !isActive(
                        item.href
                      ),
                    }"
                  >
                    <component
                      :is="item.icon"
                      class="h-5 w-5 transition-transform duration-300 ease-in-out"
                    />
                    <span
                      v-if="!isCollapsed"
                      class="ml-3 transition-opacity duration-300 ease-in-out"
                      >{{ item.title }}</span
                    >
                  </SidebarMenuButton>
                </Link>
              </SidebarMenuItem>
            </div>
          </SidebarMenu>
        </SidebarGroup>
      </SidebarContent>

      <SidebarFooter>
        <SidebarMenu>
          <SidebarMenuItem>
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <SidebarMenuButton
                  size="lg"
                  class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                  :class="{
                    '!justify-center': isCollapsed,
                    '!justify-start pl-4': !isCollapsed,
                  }"
                >
                  <Avatar class="h-7 w-7 rounded-lg">
                    <AvatarFallback class="rounded-lg">
                      {{ user.name?.substring(0, 2).toUpperCase() }}
                    </AvatarFallback>
                  </Avatar>
                  <div
                    v-if="!isCollapsed"
                    class="grid flex-1 text-left text-sm leading-tight ml-3"
                  >
                    <span class="truncate font-semibold text-gray-900 dark:text-white">{{
                      user.name
                    }}</span>
                    <span class="truncate text-xs text-gray-600 dark:text-gray-300">{{
                      user.email
                    }}</span>
                  </div>
                  <ChevronsUpDown v-if="!isCollapsed" class="ml-auto size-4" />
                </SidebarMenuButton>
              </DropdownMenuTrigger>
              <DropdownMenuContent
                class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
                :align="isCollapsed ? 'end' : 'start'"
                :side="isCollapsed ? 'right' : 'bottom'"
                :align-offset="isCollapsed ? -12 : 0"
                :side-offset="isCollapsed ? 8 : 4"
              >
                <DropdownMenuLabel class="font-normal">
                  <div class="flex items-center gap-2 p-2">
                    <Avatar class="h-7 w-7 rounded-lg">
                      <AvatarFallback class="rounded-lg">
                        {{ user.name?.substring(0, 2).toUpperCase() }}
                      </AvatarFallback>
                    </Avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                      <span class="font-medium text-gray-900 dark:text-white">{{
                        user.name
                      }}</span>
                      <span class="text-xs text-gray-600 dark:text-gray-300">{{
                        user.email
                      }}</span>
                    </div>
                  </div>
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <Link href="/profile" class="w-full">
                  <DropdownMenuItem>
                    <User class="mr-2 h-4 w-4" />
                    Profile
                  </DropdownMenuItem>
                </Link>
                <DropdownMenuSeparator />
                <Link href="/logout" method="post" as="button" class="w-full">
                  <DropdownMenuItem>
                    <LogOut class="mr-2 h-4 w-4" />
                    Logout
                  </DropdownMenuItem>
                </Link>
              </DropdownMenuContent>
            </DropdownMenu>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarFooter>
    </Sidebar>
  </SidebarProvider>
  <slot></slot>
</template>

<style scoped>
.nav-item-enter-active,
.nav-item-leave-active {
  transition: all 0.3s ease-in-out;
}

.nav-item-enter-from,
.nav-item-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}

.sidebar-button {
  transition: all 0.3s ease-in-out;
}

.sidebar-button:hover {
  transform: translateX(4px);
}

.sidebar-button.active {
  position: relative;
}

.sidebar-button.active::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 3px;
  background-color: var(--primary);
  transform: scaleY(0);
  transition: transform 0.3s ease-in-out;
}

.sidebar-button.active::before {
  transform: scaleY(1);
}

/* Hide the active indicator line in collapsed mode */
.\[w-\[80px\]\] .sidebar-button.active::before {
  display: none;
}

/* Center the icon in collapsed mode */
.\[w-\[80px\]\] .sidebar-button {
  margin: 0 auto;
  transition: all 0.3s ease-in-out;
}

/* Smooth transition for content that appears/disappears */
[v-cloak],
.v-cloak {
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
}

.v-cloak-ready {
  opacity: 1;
}
</style>
