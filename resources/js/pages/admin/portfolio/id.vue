<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import slugify from '@/utils/slugify';
import { Head, useForm } from '@inertiajs/vue3';
import ckeditor from 'ckeditor4-vue';
import { computed, defineAsyncComponent, ref, watch } from 'vue';
import type { portfolio } from './portfolio';

const breadcrumbs = defineAsyncComponent(
    () => import('@/components/admin/layout/breadcrumbs.vue'),
);
// const editor = defineAsyncComponent(
//     () => import('@/components/admin/shared/Editor.vue'),
// );

const { portfolio } = defineProps<{
    portfolio?: portfolio;
    types: { id: number; title: string }[];
}>();

const form = useForm({
    _method: portfolio?.id ? 'PATCH' : 'POST',
    title: portfolio?.title ?? '',
    slug: portfolio?.slug ?? '',
    content: portfolio?.content ?? '',
    featured_image: portfolio?.featured_image ?? (null as File | null),
    status: portfolio?.status ?? 'draft',
    type_id: portfolio?.type_id ?? null,
});

// Keep track of existing image URL for display
const existingImageUrl = ref(portfolio?.featured_image ?? '');

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
        (v: string) => !!v || 'Portfolio Title is required',
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
            return true;
        },
    ],
};

// Fixed file change handler
const handleFileChange = (file: File | null) => {
    form.featured_image = file;
};

const portfolioForm = ref();
const submit = async () => {
    const { valid } = await portfolioForm.value.validate();

    if (valid) {
        const routeName = portfolio?.id
            ? 'portfolio.update'
            : 'portfolio.store';
        const routeParams = portfolio ? [portfolio.id] : [];

        form.post(route(routeName, routeParams), {
            forceFormData: portfolio ? true : false, // Force FormData for updates
            onFinish: () => {
                console.log('Finish');
            },
            onError: (errors) => {
                console.error('Form submission errors:', errors);
            },
        });
    }
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
            <v-row>
                <v-col cols="12">
                    <breadcrumbs :items="bread" />
                </v-col>
            </v-row>
            <v-form ref="portfolioForm" @submit.prevent="submit">
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
                            <ckeditor></ckeditor>
                            <!-- <editor
                                v-model:content="form.content"
                                placeholder="eg. Long form content with image, list, etc."
                            ></editor> -->
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-card class="mb-3">
                            <v-card-text class="pb-0">
                                <v-label> Work Type </v-label>
                            </v-card-text>
                            <v-card-text>
                                <v-select
                                    v-model="form.type_id"
                                    placeholder="Select one work type"
                                    item-title="title"
                                    item-value="id"
                                    :items="types"
                                    :error-messages="form.errors.type_id"
                                ></v-select>
                            </v-card-text>
                        </v-card>
                        <v-card class="mb-3">
                            <v-card-title>Featured Image</v-card-title>
                            <v-card-text>
                                <input type="file" name="" id="" />
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
                                    {{ form.featured_image }}
                                    <v-img :src="form.featured_image"></v-img>
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
                                    ]"
                                    placeholder="Portfolio Status"
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
            </v-form>
        </v-container>
    </AuthenticatedLayout>
</template>
