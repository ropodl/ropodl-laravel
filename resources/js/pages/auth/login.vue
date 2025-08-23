<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    console.log(form);
    form.post(route('login'), {
        onFinish: () => {
            console.log(form);
            form.reset('password');
        },
    });
    console.log(form);
};
</script>

<template>
    <GuestLayout title="Log In." class="mt-16">
        <Head title="Log in" />

        <v-container>
            <v-row>
                <v-col cols="12" md="4" class="fill-height">
                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600"
                    >
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <v-text-field
                            v-model="form.email"
                            autofocus
                            placeholder="Enter Email Address"
                            density="comfortable"
                            :error-messages="form.errors.email"
                        ></v-text-field>

                        <v-text-field
                            v-model="form.password"
                            placeholder="Enter Password"
                            density="comfortable"
                            :error-messages="form.errors.password"
                        ></v-text-field>
                        <v-checkbox
                            v-model="form.remember"
                            label="Remember Me"
                        ></v-checkbox>
                        <div class="d-flex align-center justify-space-between">
                            <template v-if="canResetPassword">
                                <Link
                                    :href="route('password.request')"
                                    as="VBtn"
                                >
                                    <v-btn> Forgot your password? </v-btn>
                                </Link>
                            </template>

                            <v-btn
                                color="primary"
                                type="submit"
                                class="px-10"
                                :disabled="form.processing"
                            >
                                Log in
                            </v-btn>
                        </div>
                    </form>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
