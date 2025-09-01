<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import slugify from '@/utils/slugify';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, defineAsyncComponent, watch } from 'vue';
import { portfolio as port } from './portfolio';

const breadcrumbs = defineAsyncComponent(
    () => import('@/components/admin/layout/breadcrumbs.vue'),
);
const editor = defineAsyncComponent(
    () => import('@/components/admin/shared/Editor.vue'),
);

const { portfolio } = defineProps<{
    portfolio?: port;
}>();

const getSlug = computed((): string => {
    return slugify(form.title, {
        maxLength: 70,
    });
});

const form = useForm({
    title: portfolio?.title,
    slug: portfolio?.slug,
    content: portfolio?.content,
    status: portfolio?.status,
});

watch(
    () => form.title,
    (title) => {
        if (portfolio?.slug) return;
        else {
            form.slug = slugify(title, {
                maxLength: 70,
            });
        }
    },
);

const rules = {
    title: [
        (v?: string) =>
            (v && v.length <= 100) ||
            'Portfolio Title must be 100 characters or less',
    ],
    slug: [
        (v?: string) =>
            (v && v.length <= 70) ||
            'Portfolio Slug must be 70 characters or less',
    ],
};

const submit = () => {
    form.post(route('portfolio.store'), {
        onFinish: () => {
            // form.reset();
            alert('Finish');
        },
    });
};
</script>

<template>
    <Head>
        <title>{{ portfolio ? 'Edit' : 'Create' }} Portfolio</title>
    </Head>
    <AuthenticatedLayout :title="`${portfolio ? 'Edit' : 'Create'} Portfolio`">
        <form @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <breadcrumbs
                            :items="[
                                { title: 'portfolio', href: '/' },
                                { title: 'create', href: '/' },
                            ]"
                        />
                    </v-col>
                </v-row>
                {{ getSlug }}
                <v-row>
                    <v-col cols="12" md="8">
                        <v-label>Portfolio Title</v-label>
                        <v-text-field
                            v-model="form.title"
                            placeholder="eg. Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                            :rules="rules.title"
                        ></v-text-field>
                        <v-label>Portfolio Slug</v-label>
                        <v-text-field
                            v-model="form.slug"
                            placeholder="eg. lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit"
                            :rules="rules.slug"
                        ></v-text-field>
                        <v-label>Portfolio Content</v-label>
                        <v-card color="transparent">
                            <editor
                                v-model:content="form.content"
                                placeholder="eg. Long form content with image, list, etc."
                            ></editor>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-card class="mb-3">
                            <v-card-title>Feature Image</v-card-title>
                        </v-card>
                        <v-card>
                            <v-card-title>Actions</v-card-title>
                            <v-card-actions>
                                <v-btn type="submit">Submit</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </form>
    </AuthenticatedLayout>
</template>
