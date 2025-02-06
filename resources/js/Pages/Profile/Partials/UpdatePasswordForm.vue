<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card/index.js';
import { Input } from '@/Components/ui/input';
import { useForm } from '@inertiajs/vue3';
import { EyeIcon, EyeOffIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <Card class="h-full">
        <CardHeader class="pb-4">
            <CardTitle>Update Password</CardTitle>
            <CardDescription>
                Ensure your account is using a long, random password to stay secure.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="updatePassword" class="space-y-4">
                <div class="grid gap-4">
                    <div class="space-y-2">
                        <InputLabel for="current_password" value="Current Password" />
                        <div class="relative">
                            <Input
                                id="current_password"
                                ref="currentPasswordInput"
                                v-model="form.current_password"
                                :type="showCurrentPassword ? 'text' : 'password'"
                                class="h-9"
                                autocomplete="current-password"
                            />
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2"
                                @click="showCurrentPassword = !showCurrentPassword"
                            >
                                <EyeIcon v-if="!showCurrentPassword" class="h-4 w-4 text-gray-500" />
                                <EyeOffIcon v-else class="h-4 w-4 text-gray-500" />
                            </button>
                        </div>
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="password" value="New Password" />
                        <div class="relative">
                            <Input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                :type="showNewPassword ? 'text' : 'password'"
                                class="h-9"
                                autocomplete="new-password"
                            />
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2"
                                @click="showNewPassword = !showNewPassword"
                            >
                                <EyeIcon v-if="!showNewPassword" class="h-4 w-4 text-gray-500" />
                                <EyeOffIcon v-else class="h-4 w-4 text-gray-500" />
                            </button>
                        </div>
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <div class="relative">
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'"
                                class="h-9"
                                autocomplete="new-password"
                            />
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2"
                                @click="showConfirmPassword = !showConfirmPassword"
                            >
                                <EyeIcon v-if="!showConfirmPassword" class="h-4 w-4 text-gray-500" />
                                <EyeOffIcon v-else class="h-4 w-4 text-gray-500" />
                            </button>
                        </div>
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing" class="h-9">Save</Button>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </CardContent>
    </Card>
</template>
