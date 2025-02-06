<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutDashboard, Users, LogOut, Search, Bell } from 'lucide-vue-next';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const user = usePage().props.auth.user;
const activeView = ref('dashboard');

const navItems = [
  {
    title: 'Dashboard',
    icon: LayoutDashboard,
    to: route('dashboard'),
    isActive: true,
  },
  {
    title: 'Admin Users',
    icon: Users,
    to: route('admin.users'),
    isActive: route().current('admin.users'),
  },
];
</script>

<template>
  <div class="layout-wrapper">
    <!-- Vertical Nav -->
    <aside class="layout-vertical-nav">
      <!-- Nav Header -->
      <div class="nav-header">
        <div class="app-logo">
          <div class="logo-img">
            <ApplicationLogo />
          </div>
          <h1 class="app-title">BISU CoreScore</h1>
        </div>
      </div>

      <!-- Nav Items -->
      <div class="nav-items-wrapper">
        <nav class="nav-items">
          <Link
            v-for="item in navItems"
            :key="item.title"
            :href="item.to"
            class="nav-link"
            :class="{ active: item.isActive }"
          >
            <component
              :is="item.icon"
              class="nav-icon"
              :class="{ active: item.isActive }"
            />
            <span class="nav-text">{{ item.title }}</span>
          </Link>
        </nav>
      </div>

      <!-- User Profile -->
      <div class="nav-footer">
        <div class="user-profile">
          <div class="user-avatar">
            {{ user.name.charAt(0).toUpperCase() }}
          </div>
          <div class="user-info">
            <p class="user-name">{{ user.name }}</p>
            <p class="user-email">{{ user.email }}</p>
          </div>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="logout-btn"
          >
            <LogOut class="logout-icon" />
            <span>Log out</span>
          </Link>
        </div>
      </div>
    </aside>

    <!-- Layout Content Wrapper -->
    <div class="layout-content-wrapper">
      <!-- Navbar -->
      <header class="layout-navbar">
        <div class="navbar-content">
          <div class="navbar-left">
            <div class="search-container">
              <div class="search-wrapper">
                <Search class="search-icon" />
                <input
                  type="search"
                  class="search-input"
                  placeholder="Search..."
                />
              </div>
            </div>
          </div>

          <div class="navbar-right">
            <button class="action-btn">
              <Bell class="action-icon" />
            </button>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="layout-page-content">
        <div class="page-content-container">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.layout-wrapper {
  min-height: 100vh;
  display: flex;
  background: #f5f5f9;
}

.layout-vertical-nav {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 260px;
  background: white;
  border-right: 1px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  z-index: 50;
}

.nav-header {
  padding: 1.5rem 1.25rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #e5e7eb;
}

.app-logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.logo-img {
  width: 32px;
  height: 32px;
}

.app-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #111827;
}

.nav-items-wrapper {
  flex: 1;
  padding: 1.25rem;
  overflow-y: auto;
}

.nav-items {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.nav-link {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  color: #4b5563;
  border-radius: 0.375rem;
  text-decoration: none;
  transition: all 0.2s ease;

  &:hover {
    background: #f3f4f6;
  }

  &.active {
    background: #f3f4f6;
    color: #111827;

    .nav-icon {
      color: #111827;
    }
  }
}

.nav-icon {
  width: 1.25rem;
  height: 1.25rem;
}

.nav-text {
  font-size: 0.875rem;
  font-weight: 500;
}

.nav-footer {
  padding: 1.25rem;
  border-top: 1px solid #e5e7eb;
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.5rem;
}

.user-avatar {
  width: 2.5rem;
  height: 2.5rem;
  background: #111827;
  color: white;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
}

.user-info {
  flex: 1;
  min-width: 0;
}

.user-name {
  font-size: 0.875rem;
  font-weight: 600;
  color: #111827;
  margin: 0;
}

.user-email {
  font-size: 0.75rem;
  color: #6b7280;
  margin: 0;
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem;
  color: #ef4444;
  border: none;
  background: none;
  cursor: pointer;
  transition: color 0.2s ease;

  &:hover {
    color: #dc2626;
  }
}

.logout-icon {
  width: 1.25rem;
  height: 1.25rem;
}

.layout-content-wrapper {
  flex: 1;
  margin-left: 260px;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.layout-navbar {
  position: sticky;
  top: 0;
  background: white;
  border-bottom: 1px solid #e5e7eb;
  z-index: 40;
}

.navbar-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.5rem;
}

.navbar-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.search-container {
  max-width: 320px;
}

.search-wrapper {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 0.75rem;
  background: #f3f4f6;
  border-radius: 0.375rem;
}

.search-icon {
  width: 1.25rem;
  height: 1.25rem;
  color: #6b7280;
}

.search-input {
  border: none;
  background: none;
  outline: none;
  padding: 0;
  font-size: 0.875rem;
  color: #111827;
  width: 200px;

  &::placeholder {
    color: #6b7280;
  }
}

.navbar-right {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.action-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2rem;
  height: 2rem;
  border: none;
  background: none;
  border-radius: 0.375rem;
  color: #6b7280;
  cursor: pointer;
  transition: all 0.2s ease;

  &:hover {
    background: #f3f4f6;
  }
}

.action-icon {
  width: 1.25rem;
  height: 1.25rem;
}

.layout-page-content {
  flex: 1;
  padding: 1.5rem;
}

.page-content-container {
  max-width: 1280px;
  margin: 0 auto;
  width: 100%;
}
</style>
