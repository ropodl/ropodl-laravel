<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />
    <GuestLayout class="mt-16" title="Forgot Password.">
        <v-container>
            <v-row>
                <v-col cols="12" md="4">
                    <div class="mb-4">
                        No problem. Just let us know your email address and we
                        will email you a password reset link that will allow you
                        to choose a new one.
                    </div>
                    <template v-if="status">
                        <v-alert color="success" density="compact" class="mb-4">
                            {{ status }}
                        </v-alert>
                    </template>

                    <form @submit.prevent="submit">
                        <v-text-field
                            v-model="form.email"
                            placeholder="Email Address"
                            :error-messages="form.errors.email"
                            :loading="form.processing"
                            @input="form.errors.email = ''"
                        ></v-text-field>

                        <v-btn
                            type="submit"
                            color="primary"
                            :disabled="form.processing"
                        >
                            Send Password Reset Link
                        </v-btn>
                    </form>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
