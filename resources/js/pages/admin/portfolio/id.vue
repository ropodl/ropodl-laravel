<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Icon } from '@iconify/vue';
import { useForm } from '@inertiajs/vue3';
import { portfolio as port } from './portfolio';

const { portfolio } = defineProps<{
    portfolio?: port;
}>();

const form = useForm({
    title: portfolio?.title,
    slug: portfolio?.slug,
    content: portfolio?.content,
    status: portfolio?.status,
});

const submit = () => {
    form.post(route('portfolio.store'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AuthenticatedLayout :title="`${portfolio ? 'Edit' : 'Create'} Portfolio`">
        {{ portfolio }}
        {{ form }}
        <form @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col cols="12" md="8">
                        <div class="d-flex align-center mb-3">
                            <v-btn border icon class="me-3">
                                <v-icon>
                                    <Icon icon="carbon:arrow-left" />
                                </v-icon>
                            </v-btn>
                            <div class="text-h3">
                                {{ portfolio ? 'Edit' : 'Create' }} Portfolio
                            </div>
                        </div>
                        <v-card>
                            <v-card-title>Money</v-card-title>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-card>
                            <v-card-title>Title</v-card-title>
                        </v-card>
                        <v-btn type="submit">Submit</v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </form>
    </AuthenticatedLayout>
</template>
