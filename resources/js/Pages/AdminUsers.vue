<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import UsersTable from "@/Components/UsersTable.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

defineProps({
  users: {
    type: Array,
    required: true,
  },
});

const showCreateModal = ref(false);

const form = useForm({
  name: "",
  email: "",
  password: "",
  is_admin: false,
});

const createUser = () => {
  form.post(route("admin.users.store"), {
    onSuccess: () => {
      showCreateModal.value = false;
      form.reset();
    },
  });
};
</script>

<template>
  <Head title="Admin Users" />

  <DashboardLayout>
    <div class="space-y-4">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold tracking-tight text-foreground">Admin Accounts</h1>
        <PrimaryButton @click="showCreateModal = true">Add User</PrimaryButton>
      </div>
      <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
        <div class="p-6">
          <h3 class="text-lg font-medium mb-4 text-foreground">Account Management</h3>
          <UsersTable :users="users" />
        </div>
      </div>
    </div>

    <Modal :show="showCreateModal" @close="showCreateModal = false">
      <div class="p-6 bg-card text-card-foreground">
        <h2 class="text-xl font-semibold text-foreground">Create New User</h2>
        <p class="mt-2 text-sm text-muted-foreground">
          Add a new user to the system. All fields are required.
        </p>

        <form @submit.prevent="createUser" class="mt-6 space-y-6">
          <div>
            <InputLabel for="name" value="Name" class="text-foreground" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full bg-background text-foreground"
              v-model="form.name"
              required
              autofocus
            />
            <InputError :message="form.errors.name" class="mt-2" />
          </div>

          <div>
            <InputLabel for="email" value="Email" class="text-foreground" />
            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full bg-background text-foreground"
              v-model="form.email"
              required
            />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <div>
            <InputLabel for="password" value="Password" class="text-foreground" />
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full bg-background text-foreground"
              v-model="form.password"
              required
            />
            <InputError :message="form.errors.password" class="mt-2" />
          </div>

          <div class="flex items-center space-x-2">
            <input
              id="is_admin"
              type="checkbox"
              v-model="form.is_admin"
              class="h-4 w-4 rounded border-border bg-background text-primary focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-background"
            />
            <InputLabel
              for="is_admin"
              value="Grant admin privileges"
              class="text-foreground"
            />
          </div>

          <div class="flex justify-end gap-4 mt-6 border-t border-border pt-6">
            <SecondaryButton @click="showCreateModal = false" type="button">
              Cancel
            </SecondaryButton>
            <PrimaryButton :disabled="form.processing"> Create User </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>
  </DashboardLayout>
</template>
