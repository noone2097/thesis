<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import ThemeToggle from "@/Components/ThemeToggle.vue";

defineProps({
  canLogin: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

onMounted(() => {
  const leftSections = document.querySelectorAll(
    ".fixed .grid > div:first-child .reveal-section"
  );
  const rightSections = document.querySelectorAll(
    ".fixed .grid > div:last-child .reveal-section"
  );

  const revealSide = (sections, delay = 0) => {
    sections.forEach((section) => {
      setTimeout(() => {
        section.classList.add("reveal-visible");
      }, delay);
    });
  };

  revealSide(leftSections);
  revealSide(rightSections);
});
</script>

<template>
  <Head title="Welcome" />
  <div class="fixed inset-0">
    <div class="h-full grid grid-cols-1 lg:grid-cols-2">
      <!-- Left Column -->
      <div
        class="relative bg-gradient-to-b from-blue-900/90 to-indigo-900/90 text-white p-6 flex flex-col items-center justify-between space-y-4"
      >
        <!-- Logo and Title -->
        <div class="reveal-section flex flex-col items-center opacity-0">
          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-b from-blue-500/20 to-transparent rounded-full blur-xl"
            ></div>
            <img
              src="/images/bisu_logo.png"
              alt="BISU Logo"
              class="w-24 h-24 object-contain relative z-10"
            />
          </div>
          <div class="text-center mt-4">
            <h1 class="text-xl font-medium tracking-wider mb-1">
              BOHOL ISLAND STATE UNIVERSITY
            </h1>
            <p class="text-white/70 text-sm">Calape Campus</p>
          </div>
        </div>

        <!-- Mission and Vision -->
        <div class="grid grid-cols-2 gap-8 w-full px-2 -mt-8">
          <div class="reveal-section opacity-0 translate-y-8 px-2">
            <div class="relative text-center">
              <span
                class="absolute -top-4 left-1/2 -translate-x-1/2 text-6xl font-bold text-white/5 select-none"
                >V</span
              >
              <h2
                class="text-xs font-medium mb-3 uppercase tracking-widest text-white/90"
              >
                Vision
              </h2>
              <p class="text-xs text-white/70 leading-relaxed text-justify goals-item">
                A premier Science and Technology university for the formation of world
                class and virtuous human resource for sustainable development in Bohol and
                the Country.
              </p>
            </div>
          </div>

          <div class="reveal-section opacity-0 translate-y-8">
            <div class="relative text-center">
              <span
                class="absolute -top-4 left-1/2 -translate-x-1/2 text-6xl font-bold text-white/5 select-none"
                >M</span
              >
              <h2
                class="text-xs font-medium mb-3 uppercase tracking-widest text-white/90"
              >
                Mission
              </h2>
              <p class="text-xs text-white/70 leading-relaxed text-justify goals-item">
                BISU is committed to provide quality higher education in the arts and
                sciences, as well as in the professional and technological fields;
                undertake research and development and extension services for the
                sustainable development of Bohol and the country.
              </p>
            </div>
          </div>
        </div>

        <!-- Goals -->
        <div class="reveal-section opacity-0 translate-y-8 text-center w-full px-2 -mt-4">
          <div class="relative">
            <span
              class="absolute -top-4 left-1/2 -translate-x-1/2 text-6xl font-bold text-white/5 select-none"
              >G</span
            >
            <h2 class="text-xs font-medium mb-4 uppercase tracking-widest text-white/90">
              Goals
            </h2>
            <div class="grid grid-cols-2 gap-x-2 gap-y-1 text-xs text-white/70">
              <div class="goals-item">Excellence in Instruction and Learning</div>
              <div class="goals-item">Excellence in Research and Innovation</div>
              <div class="goals-item">Excellence in Community Engagement</div>
              <div class="goals-item">Excellence in Institutional Development</div>
            </div>
          </div>
        </div>

        <!-- Copyright Footer -->
        <div class="text-center text-xs text-white/50 mt-6">
          <p>&copy; 2025 BISU CoreScore. All rights reserved.</p>
        </div>
      </div>

      <!-- Right Column -->
      <div class="p-8 flex flex-col items-center justify-center bg-background">
        <!-- Theme Toggle -->
        <div class="absolute top-4 right-4 z-10">
          <ThemeToggle />
        </div>

        <div class="reveal-section opacity-0 max-w-md w-full space-y-8 text-center">
          <div class="text-center mb-8">
            <div class="relative inline-block">
              <span
                class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"
              ></span>
              <h1 class="relative text-3xl font-medium tracking-wide text-foreground">
                <span class="relative">BISU</span>
                <span class="relative ml-2">
                  <span class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"></span>
                  <span class="relative">CoreScore</span>
                </span>
              </h1>
            </div>
            <p class="mt-2 text-muted-foreground">Innovation Through Excellence</p>
          </div>

          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent rounded-lg"
            ></div>
            <div
              class="relative bg-card text-card-foreground shadow-sm backdrop-blur-sm rounded-lg px-6 py-6 space-y-3"
            >
              <h3 class="text-base font-medium">About CoreScore</h3>
              <p class="text-sm text-muted-foreground leading-relaxed">
                BISU CoreScore is an innovative performance evaluation system designed to
                streamline and enhance the assessment process for our faculty and staff.
                Experience a modern, efficient, and transparent way of managing
                evaluations.
              </p>
            </div>
          </div>

          <div>
            <div v-if="$page.props.auth.user">
              <Link
                :href="route('dashboard')"
                class="login-button inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-8 py-2 w-full"
              >
                Go to Dashboard
              </Link>
            </div>
            <div v-else>
              <Link
                :href="route('login')"
                class="login-button inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-8 py-2 w-full"
              >
                Login to CoreScore
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.text-muted-foreground {
  color: hsl(var(--muted-foreground));
}

.bg-card {
  background-color: hsl(var(--card) / 0.5);
  border: 1px solid hsl(var(--border) / 0.2);
}

.text-card-foreground {
  color: hsl(var(--card-foreground));
}

/* Reveal animations */
.reveal-section {
  transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.reveal-visible {
  opacity: 1 !important;
  transform: translateY(0) !important;
}

/* Goals items hover effect */
.goals-item {
  position: relative;
  padding: 0.25rem;
  transition: all 0.3s ease;
}

.goals-item::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 0.5rem;
  background: linear-gradient(
    to right,
    transparent,
    rgba(255, 255, 255, 0.1),
    transparent
  );
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.goals-item:hover::before {
  transform: scaleX(1);
}

/* Login button hover effect */
.login-button {
  position: relative;
  overflow: hidden;
}

.login-button::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    to right,
    transparent,
    rgba(255, 255, 255, 0.1),
    transparent
  );
  transition: 0.5s;
}

.login-button:hover::before {
  left: 100%;
}

/* Gradient animation */
@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.bg-gradient-to-b {
  background-size: 200% 200%;
  animation: gradient 20s ease infinite;
}
</style>
