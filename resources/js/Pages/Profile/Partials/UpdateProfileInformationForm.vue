<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card/index.js';
import { Input } from '@/Components/ui/input';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const photoPreview = ref(null);

const form = useForm({
    name: user.name,
    email: user.email,
    photo: null,
});

const selectNewPhoto = (e) => {
    if (e.target.files[0]) {
        form.photo = e.target.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };
        reader.readAsDataURL(form.photo);
    }
};
</script>

<template>
    <Card class="h-full">
        <CardHeader class="pb-4">
            <CardTitle>Profile Information</CardTitle>
            <CardDescription>
                Update your account's profile information and email address.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-4">
                <div class="flex items-center gap-4">
                    <Avatar class="h-16 w-16">
                        <AvatarImage
                            v-if="photoPreview"
                            :src="photoPreview"
                            :alt="user.name"
                        />
                        <AvatarImage
                            v-else-if="user.profile_photo_url"
                            :src="user.profile_photo_url"
                            :alt="user.name"
                        />
                        <AvatarFallback v-else>
                            {{ user.name.charAt(0).toUpperCase() }}
                        </AvatarFallback>
                    </Avatar>
                    <Button variant="outline" as="label" class="cursor-pointer text-sm h-9">
                        <input
                            type="file"
                            class="hidden"
                            @change="selectNewPhoto"
                            accept="image/*"
                        />
                        Change Photo
                    </Button>
                </div>

                <div class="grid gap-4">
                    <div class="space-y-2">
                        <InputLabel for="name" value="Name" />
                        <Input
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            class="h-9"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="email" value="Email" />
                        <Input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            class="h-9"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null" class="text-sm">
                    <p class="text-gray-800">
                        Your email address is unverified.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="text-gray-600 underline hover:text-gray-900"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="status === 'verification-link-sent'"
                        class="mt-2 font-medium text-green-600"
                    >
                        A new verification link has been sent to your email address.
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
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </CardContent>
    </Card>
</template>
