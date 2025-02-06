<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <DashboardLayout>
        <div class="p-4">
            <div class="mx-auto max-w-7xl space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="h-full"
                    />
                    <UpdatePasswordForm class="h-full" />
                </div>

                <DeleteUserForm />
            </div>
        </div>
    </DashboardLayout>
</template>
