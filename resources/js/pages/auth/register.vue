<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Icon } from '@iconify/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Register" />
    <GuestLayout title="Register." class="mt-16">
        <v-container>
            <v-row>
                <v-col col="12" md="4">
                    <form @submit.prevent="submit">
                        <v-text-field
                            v-model="form.name"
                            placeholder="Full Name"
                            autocomplete="name"
                            :error-messages="form.errors.name"
                        ></v-text-field>
                        <!-- autofocus
                        autofocus -->
                        <v-text-field
                            v-model="form.email"
                            placeholder="Email Address"
                            autocomplete="username"
                            :error-messages="form.errors.email"
                        ></v-text-field>
                        <v-text-field
                            v-model="form.password"
                            placeholder="Password"
                            :type="showPassword ? 'text' : 'password'"
                            :error-messages="form.errors.password"
                        >
                            <template #append-inner>
                                <v-icon @click="showPassword = !showPassword">
                                    <Icon
                                        :icon="
                                            showPassword
                                                ? 'carbon:view-off'
                                                : 'carbon-view'
                                        "
                                    ></Icon>
                                </v-icon>
                            </template>
                        </v-text-field>
                        <v-text-field
                            v-model="form.password_confirmation"
                            placeholder="Confirm Password"
                            :type="showConfirmPassword ? 'text' : 'password'"
                            :error-messages="form.errors.password_confirmation"
                        >
                            <template #append-inner>
                                <v-icon
                                    @click="
                                        showConfirmPassword =
                                            !showConfirmPassword
                                    "
                                >
                                    <Icon
                                        :icon="
                                            showConfirmPassword
                                                ? 'carbon:view-off'
                                                : 'carbon-view'
                                        "
                                    ></Icon>
                                </v-icon>
                            </template>
                        </v-text-field>
                        <div class="d-flex align-center justify-space-between">
                            <Link :href="route('login')" as="VBtn">
                                <v-btn> Already registered? </v-btn>
                            </Link>

                            <v-btn
                                color="primary"
                                type="submit"
                                class="px-10"
                                :disabled="form.processing"
                            >
                                Register
                            </v-btn>
                        </div>
                    </form>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
