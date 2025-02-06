<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ThemeToggle from "@/Components/ThemeToggle.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};

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
  revealSide(rightSections, 200);
});
</script>

<template>
  <Head title="Reset Password" />
  <div class="fixed inset-0">
    <div class="h-full grid grid-cols-1 lg:grid-cols-2">
      <!-- Left Column -->
      <div class="relative overflow-hidden">
        <img
          src="/images/campus.jpg"
          alt="BISU Campus"
          class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/90 to-indigo-900/90">
          <div
            class="reveal-section opacity-0 h-full flex flex-col items-center justify-center p-6 text-white"
          >
            <div class="relative mb-8">
              <div
                class="absolute inset-0 bg-gradient-to-b from-blue-500/20 to-transparent rounded-full blur"
              ></div>
              <img
                src="/images/bisu_logo.png"
                alt="BISU Logo"
                class="w-24 h-24 object-contain relative z-10"
              />
            </div>
            <div class="text-center">
              <h1 class="text-xl font-medium tracking-wider mb-1">
                BOHOL ISLAND STATE UNIVERSITY
              </h1>
              <p class="text-white/70 text-sm">Calape Campus</p>
            </div>
            <div
              class="mt-8 bg-white/10 rounded-lg border border-white/10 p-6 max-w-lg mx-auto"
            >
              <div class="flex items-center space-x-4">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-8 w-8"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                  />
                </svg>
                <div>
                  <h2 class="text-lg font-semibold">Create a Strong Password</h2>
                  <p class="text-sm text-white/80">
                    Use a combination of letters, numbers, and special characters
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div
        class="relative p-8 flex flex-col items-center justify-center bg-background text-foreground"
      >
        <!-- Theme Toggle -->
        <div class="absolute top-4 right-4 z-10">
          <ThemeToggle />
        </div>

        <div class="reveal-section opacity-0 max-w-md w-full space-y-8">
          <div class="space-y-2 text-center">
            <div class="relative inline-block">
              <span
                class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"
              ></span>
              <h2 class="relative text-2xl font-medium tracking-wide text-foreground">
                Reset Password
              </h2>
            </div>
            <p class="text-sm text-muted-foreground">Enter your new password below</p>
          </div>

          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent rounded-lg"
            ></div>
            <div
              class="relative bg-card/95 text-card-foreground shadow-sm rounded-lg p-6 border border-border/50"
            >
              <form @submit.prevent="submit" class="space-y-4">
                <div>
                  <InputLabel
                    for="email"
                    value="Email"
                    class="text-sm font-medium text-foreground dark:text-foreground/90"
                  />
                  <TextInput
                    id="email"
                    type="email"
                    class="mt-1.5 block w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background text-foreground dark:text-foreground/90 placeholder:text-muted-foreground dark:placeholder:text-muted-foreground/70 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background"
                    v-model="form.email"
                    required
                    readonly
                  />
                  <InputError
                    class="mt-2 text-xs text-red-500 dark:text-red-400"
                    :message="form.errors.email"
                  />
                </div>

                <div>
                  <InputLabel
                    for="password"
                    value="New Password"
                    class="text-sm font-medium text-foreground dark:text-foreground/90"
                  />
                  <TextInput
                    id="password"
                    type="password"
                    class="mt-1.5 block w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background text-foreground dark:text-foreground/90 placeholder:text-muted-foreground dark:placeholder:text-muted-foreground/70 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                  />
                  <InputError
                    class="mt-2 text-xs text-red-500 dark:text-red-400"
                    :message="form.errors.password"
                  />
                </div>

                <div>
                  <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                    class="text-sm font-medium text-foreground dark:text-foreground/90"
                  />
                  <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1.5 block w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background text-foreground dark:text-foreground/90 placeholder:text-muted-foreground dark:placeholder:text-muted-foreground/70 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your new password"
                  />
                  <InputError
                    class="mt-2 text-xs text-red-500 dark:text-red-400"
                    :message="form.errors.password_confirmation"
                  />
                </div>

                <PrimaryButton
                  class="w-full justify-center mt-6 bg-primary text-primary-foreground hover:bg-primary/90"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Reset Password
                </PrimaryButton>

                <div class="relative mt-6 pt-6">
                  <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div
                      class="w-full border-t border-border dark:border-border/40"
                    ></div>
                  </div>
                  <div class="relative flex justify-center">
                    <div class="relative inline-block">
                      <span
                        class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"
                      ></span>
                      <Link
                        :href="route('login')"
                        class="relative text-sm font-medium text-primary hover:text-primary/90 dark:text-primary-foreground dark:hover:text-primary-foreground/90 transition-colors px-2 bg-card"
                      >
                        Back to login
                      </Link>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
* {
  transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.text-muted-foreground {
  color: hsl(var(--muted-foreground));
}

.bg-card {
  background-color: hsl(var(--card));
}

.text-card-foreground {
  color: hsl(var(--card-foreground));
}

.border-input {
  border-color: hsl(var(--input));
}

/* Reveal animations */
.reveal-section {
  transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.reveal-visible {
  opacity: 1 !important;
  transform: translateY(0) !important;
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

:deep(.dark) {
  .text-foreground {
    color: hsl(var(--foreground));
  }

  .bg-background {
    background-color: hsl(var(--background));
  }

  .border-input {
    border-color: hsl(var(--input));
  }
}
</style>
