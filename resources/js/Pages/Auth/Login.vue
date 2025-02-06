<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ThemeToggle from "@/Components/ThemeToggle.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const showPassword = ref(false);

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
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
  <Head title="Log in" />
  <div class="fixed inset-0">
    <div class="h-full grid grid-cols-1 lg:grid-cols-2">
      <!-- Left Column -->
      <div class="relative overflow-hidden">
        <img
          src="/images/campus.jpg"
          alt="BISU Campus"
          class="absolute inset-0 w-full h-full object-cover object-[15%_center]"
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
            <div class="flex flex-col items-center space-y-4">
              <div class="relative p-3 bg-primary/10 rounded-full">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-8 h-8 text-primary"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                  />
                </svg>
              </div>
              <div class="relative inline-block">
                <span
                  class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"
                ></span>
                <h2 class="relative text-2xl font-medium tracking-wide text-foreground">
                  Welcome Back
                </h2>
              </div>
            </div>
            <p class="text-sm text-muted-foreground">Sign in to your account</p>
          </div>

          <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
          >
            {{ status }}
          </div>

          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent rounded-lg"
            ></div>
            <div
              class="relative bg-card/95 text-card-foreground shadow-sm rounded-lg p-8 border border-border/50"
            >
              <form @submit.prevent="submit" class="space-y-4">
                <div class="space-y-4">
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
                      autocomplete="username"
                      placeholder="Enter your email"
                    />
                    <InputError
                      class="mt-2 text-xs text-red-500 dark:text-red-400"
                      :message="form.errors.email"
                    />
                  </div>

                  <div>
                    <InputLabel
                      for="password"
                      value="Password"
                      class="text-sm font-medium text-foreground dark:text-foreground/90"
                    />
                    <div class="relative">
                      <TextInput
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="mt-1.5 block w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background text-foreground dark:text-foreground/90 placeholder:text-muted-foreground dark:placeholder:text-muted-foreground/70 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                      />
                      <button
                        type="button"
                        class="absolute right-2 top-[calc(50%_-_2px)] transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none"
                        @click="showPassword = !showPassword"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5"
                          :class="{ hidden: showPassword }"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                          <path
                            fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"
                          />
                        </svg>
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5"
                          :class="{ hidden: !showPassword }"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                            clip-rule="evenodd"
                          />
                          <path
                            d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                          />
                        </svg>
                      </button>
                    </div>
                    <InputError
                      class="mt-2 text-xs text-red-500 dark:text-red-400"
                      :message="form.errors.password"
                    />
                  </div>
                </div>

                <div class="flex items-center">
                  <label class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      name="remember"
                      v-model="form.remember"
                      class="h-4 w-4 rounded border-input bg-background text-primary shadow focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    />
                    <span
                      class="text-sm text-muted-foreground dark:text-muted-foreground/90"
                      >Remember me</span
                    >
                  </label>
                </div>

                <PrimaryButton
                  class="w-full justify-center mt-6 bg-primary text-primary-foreground hover:bg-primary/90"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  :loading="form.processing"
                >
                  Sign in
                </PrimaryButton>

                <div class="relative mt-8">
                  <div class="flex items-center justify-center gap-4">
                    <div class="w-16 border-t border-gray-300 dark:border-gray-600"></div>
                    <Link
                      v-if="canResetPassword"
                      :href="route('password.request')"
                      class="text-sm text-gray-900 hover:underline dark:text-gray-100"
                    >
                      Forgot your password?
                    </Link>
                    <div class="w-16 border-t border-gray-300 dark:border-gray-600"></div>
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
