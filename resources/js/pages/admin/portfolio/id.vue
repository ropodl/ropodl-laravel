<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import slugify from '@/utils/slugify';
import { Head, useForm } from '@inertiajs/vue3';
import { useObjectUrl } from '@vueuse/core';
import { computed, defineAsyncComponent, ref, watch } from 'vue';
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

const form = useForm({
    title: portfolio?.title || '',
    slug: portfolio?.slug || '',
    content: portfolio?.content || '',
    featured_image: null as File | null,
    status: portfolio?.status || 'draft',
});

// Keep track of existing image URL for display
const existingImageUrl = ref(portfolio?.featured_image || '');

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
    featured_image: [
        (v?: File[]) => {
            if (!v || v.length === 0) return true;
            // const file = v[0];
            // const maxSize = 5 * 1024 * 1024; // 5MB
            // const allowedTypes = [
            //     'image/jpeg',
            //     'image/png',
            //     'image/gif',
            //     'image/webp',
            // ];

            // if (file.size > maxSize) {
            //     return 'File size must be less than 5MB';
            // }
            // if (!allowedTypes.includes(file.type)) {
            //     return 'Only JPEG, PNG, GIF, and WebP images are allowed';
            // }
            return true;
        },
    ],
};

// Fixed file change handler
const handleFileChange = (file: any) => {
    console.log('File change event:', file);
    form.featured_image = file;
    // console.log('Files received:', files);

    // if (files && files.name) {
    //     const file = files;
    //     form.featured_image = file;
    //     // Clear any previous error
    //     form.errors.featured_image = '';
    //     console.log('File selected:', file.name, 'Size:', file.size);
    // } else {
    //     form.featured_image = null;
    //     console.log('No file selected or file cleared');
    // }
};

const submit = () => {
    const method = portfolio ? 'patch' : 'post';
    console.log('Form data:', form);
    console.log('Featured image:', form.featured_image);

    const routeName = portfolio ? 'portfolio.update' : 'portfolio.store';
    const routeParams = portfolio ? [portfolio.id] : [];

    form[method](route(routeName, routeParams), {
        // forceFormData: form.featured_image ? true : false,
        onFinish: () => {
            console.log('Finish');
        },
        onError: (errors) => {
            console.error('Form submission errors:', errors);
        },
    });
};

const bread = computed<BreadcrumbItem[]>(() => {
    return [
        {
            title: 'portfolio',
            href: '/admin/portfolio',
        },
        {
            title: portfolio ? 'edit' : 'create',
            href: portfolio
                ? `/admin/portfolio/${portfolio.id}`
                : '/admin/portfolio/create',
        },
    ];
});
</script>

<template>
    <Head>
        <title>{{ portfolio ? 'Edit' : 'Create' }} Portfolio</title>
    </Head>
    <AuthenticatedLayout :title="`${portfolio ? 'Edit' : 'Create'} Portfolio`">
        <v-container>
            <v-row> </v-row>
        </v-container>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <breadcrumbs :items="bread" />
                </v-col>
            </v-row>
            <form @submit.prevent="submit">
                <v-row>
                    <v-col cols="12" md="8">
                        <v-label>Portfolio Title</v-label>
                        <v-text-field
                            v-model="form.title"
                            placeholder="eg. Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                            :rules="rules.title"
                            :error-messages="form.errors.title"
                            @update:model-value="form.errors.title = ''"
                        ></v-text-field>

                        <v-label>Portfolio Slug</v-label>
                        <v-text-field
                            v-model="form.slug"
                            placeholder="eg. lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit"
                            :rules="rules.slug"
                            :error-messages="form.errors.slug"
                            @update:model-value="form.errors.slug = ''"
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
                            <v-card-title>Featured Image</v-card-title>
                            <v-card-text>
                                <!-- Show existing image if available -->
                                <div
                                    v-if="
                                        existingImageUrl && !form.featured_image
                                    "
                                    class="mb-3"
                                >
                                    <v-img
                                        :src="existingImageUrl"
                                        max-height="200"
                                        class="mb-2"
                                        cover
                                    ></v-img>
                                    <v-chip size="small" color="success"
                                        >Current Image</v-chip
                                    >
                                </div>

                                <!-- Show preview of new file -->
                                <div v-if="form.featured_image" class="mb-3">
                                    <v-img
                                        :src="
                                            <any>(
                                                useObjectUrl(
                                                    form.featured_image,
                                                )
                                            )
                                        "
                                        max-height="200"
                                        class="mb-2"
                                        cover
                                    ></v-img>
                                    <v-chip size="small" color="primary"
                                        >New Image Selected:
                                        {{ form.featured_image.name }}</v-chip
                                    >
                                </div>

                                <!-- File input with proper v-model handling -->
                                <v-file-input
                                    :model-value="
                                        form.featured_image
                                            ? [form.featured_image]
                                            : []
                                    "
                                    label="Choose featured image"
                                    accept="image/*"
                                    prepend-icon="mdi-camera"
                                    :rules="rules.featured_image"
                                    :error-messages="form.errors.featured_image"
                                    @update:model-value="handleFileChange"
                                    @click:clear="handleFileChange(null)"
                                ></v-file-input>

                                <v-card-subtitle class="px-0 text-caption">
                                    Accepted formats: JPEG, PNG, GIF, WebP (Max:
                                    5MB)
                                </v-card-subtitle>
                            </v-card-text>
                        </v-card>

                        <v-card>
                            <v-card-title>Status</v-card-title>
                            <v-card-text>
                                <v-select
                                    v-model="form.status"
                                    :items="[
                                        { title: 'Draft', value: 'draft' },
                                        {
                                            title: 'Published',
                                            value: 'published',
                                        },
                                        {
                                            title: 'Archived',
                                            value: 'archived',
                                        },
                                    ]"
                                    label="Portfolio Status"
                                ></v-select>
                            </v-card-text>
                        </v-card>

                        <v-card class="mt-3">
                            <v-card-title>Actions</v-card-title>
                            <v-card-actions>
                                <v-btn
                                    type="submit"
                                    color="primary"
                                    :loading="form.processing"
                                    :disabled="form.processing"
                                >
                                    {{ portfolio ? 'Update' : 'Create' }}
                                    Portfolio
                                </v-btn>
                                <v-btn
                                    variant="outlined"
                                    @click="$inertia.visit('/admin/portfolio')"
                                >
                                    Cancel
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </form>
        </v-container>
    </AuthenticatedLayout>
</template>
