<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ThemeToggle from "@/Components/ThemeToggle.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
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
  <Head title="Forgot Password" />
  <div class="fixed inset-0">
    <div class="h-full grid grid-cols-1 lg:grid-cols-2">
      <!-- Left Column -->
      <div class="relative overflow-hidden">
        <img
          src="/images/campus.jpg"
          alt="BISU Campus"
          class="absolute inset-0 w-full h-full object-cover object-[1therrer5%_center]"
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
            <div class="relative inline-block">
              <span
                class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"
              ></span>
              <h2 class="relative text-2xl font-medium tracking-wide text-foreground">
                <span class="relative">Forgot</span>
                <span class="relative ml-2">
                  <span class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent blur"></span>
                  <span class="relative">Password?</span>
                </span>
              </h2>
            </div>
            <p class="text-sm text-muted-foreground">
              No worries, we'll send you reset instructions.
            </p>
          </div>

          <div class="relative">
            <div
              class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent rounded-lg"
            ></div>
            <div
              class="relative bg-card/95 text-card-foreground shadow-sm rounded-lg p-8 border border-border/50"
            >
              <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
              >
                {{ status }}
              </div>

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
                    autocomplete="username"
                    placeholder="Enter your email"
                  />
                  <InputError
                    class="mt-2 text-xs text-red-500 dark:text-red-400"
                    :message="form.errors.email"
                  />
                </div>

                <PrimaryButton
                  class="w-full justify-center mt-6 bg-primary text-primary-foreground hover:bg-primary/90"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  :loading="form.processing"
                >
                  Email Password Reset Link
                </PrimaryButton>

                <div class="relative mt-8">
                  <div class="flex items-center justify-center gap-4">
                    <div class="w-16 border-t border-gray-300 dark:border-gray-600"></div>
                    <Link
                      :href="route('login')"
                      class="text-sm text-gray-900 hover:underline dark:text-gray-100"
                    >
                      Back to login
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
