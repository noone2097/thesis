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

const emit = defineEmits(['update:collapsed']);

const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value;
  emit('update:collapsed', isCollapsed.value);
};

const navigationItems = [
  {
    title: "Dashboard",
    href: "/dashboard",
    icon: LayoutDashboard,
    items: [
      {
        title: "Overview",
        href: "/dashboard",
      },
      {
        title: "Analytics",
        href: "/dashboard/analytics",
      },
      {
        title: "Reports",
        href: "/dashboard/reports",
      },
    ],
  },
  {
    title: "Admin Accounts",
    href: "/admin/users",
    icon: Users,
    items: [
      {
        title: "All Users",
        href: "/admin/users",
      },
      {
        title: "Add User",
        href: "/admin/users/create",
      },
    ],
  },
  {
    title: "Admin Roles",
    href: "/admin/roles",
    icon: Shield,
    items: [
      {
        title: "All Roles",
        href: "/admin/roles",
      },
      {
        title: "Add Role",
        href: "/admin/roles/create",
      },
    ],
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
      class="fixed top-0 left-0 h-screen z-20 transition-all duration-200 bg-white dark:bg-gray-900 border-r"
    >
      <SidebarHeader>
        <!-- Top buttons row -->
        <div class="relative h-[52px]">
          <div
            class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-between w-[calc(100%-32px)]"
          >
            <button
              @click="toggleSidebar"
              class="text-sidebar-foreground hover:text-primary flex items-center justify-center h-7 w-7"
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
                  <span class="truncate font-semibold">CoreScore</span>
                  <span class="truncate text-xs">Admin Panel</span>
                </div>
              </div>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>

      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel v-if="!isCollapsed" class="px-4"
            >Navigation</SidebarGroupLabel
          >
          <SidebarMenu>
            <Collapsible
              v-for="item in navigationItems"
              :key="item.title"
              as-child
              class="group/collapsible"
            >
              <SidebarMenuItem>
                <CollapsibleTrigger as-child>
                  <SidebarMenuButton
                    :tooltip="isCollapsed ? item.title : ''"
                    :class="{
                      '!justify-center': isCollapsed,
                      '!justify-start pl-4': !isCollapsed,
                    }"
                  >
                    <component
                      :is="item.icon"
                      :class="{ 'h-5 w-5': isCollapsed, 'h-4 w-4': !isCollapsed }"
                    />
                    <span v-if="!isCollapsed" class="ml-3">{{ item.title }}</span>
                  </SidebarMenuButton>
                </CollapsibleTrigger>
                <CollapsibleContent v-if="!isCollapsed">
                  <SidebarMenuSub>
                    <SidebarMenuSubItem
                      v-for="subItem in item.items"
                      :key="subItem.title"
                    >
                      <Link :href="subItem.href">
                        <SidebarMenuSubButton as-child class="pl-11">
                          <span>{{ subItem.title }}</span>
                        </SidebarMenuSubButton>
                      </Link>
                    </SidebarMenuSubItem>
                  </SidebarMenuSub>
                </CollapsibleContent>
              </SidebarMenuItem>
            </Collapsible>
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
                    <span class="truncate font-semibold">{{ user.name }}</span>
                    <span class="truncate text-xs">{{ user.email }}</span>
                  </div>
                  <ChevronsUpDown v-if="!isCollapsed" class="ml-auto size-4" />
                </SidebarMenuButton>
              </DropdownMenuTrigger>
              <DropdownMenuContent
                class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
                side="top"
                align="start"
                :side-offset="4"
              >
                <DropdownMenuLabel class="font-normal">
                  <div class="flex items-center gap-2 p-2">
                    <Avatar class="h-7 w-7 rounded-lg">
                      <AvatarFallback class="rounded-lg">
                        {{ user.name?.substring(0, 2).toUpperCase() }}
                      </AvatarFallback>
                    </Avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                      <span class="font-medium">{{ user.name }}</span>
                      <span class="text-xs text-muted-foreground">{{ user.email }}</span>
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
