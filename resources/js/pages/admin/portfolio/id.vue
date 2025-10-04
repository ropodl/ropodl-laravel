<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import slugify from '@/utils/slugify';
import { Head, router, useForm } from '@inertiajs/vue3';
import { useObjectUrl } from '@vueuse/core';
import { computed, defineAsyncComponent, ref, Ref, watch } from 'vue';
import type { portfolio } from './portfolio';

const breadcrumbs = defineAsyncComponent(
    () => import('@/components/admin/layout/breadcrumbs.vue'),
);
const editor = defineAsyncComponent(
    () => import('@/components/admin/shared/Editor.vue'),
);

const { portfolio, types } = defineProps<{
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
    portfolio_type_id: portfolio?.portfolio_type_id ?? null,
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
            const file = v[0];
            if (file && file.size > 5120 * 1024) {
                return 'File size must be less than 5MB';
            }
            return true;
        },
    ],
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
            forceFormData: true, // Always force FormData when dealing with files
            preserveScroll: false,
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

const fileSelected = ref(null as File | null);
const filePreview = ref<Ref | null>(null);
const uploadFile = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        fileSelected.value = target.files[0];
        filePreview.value = useObjectUrl(target.files[0]);
        form.featured_image = fileSelected.value;
    }
};

const removeImage = () => {
    filePreview.value = null;
    fileSelected.value = null;
    form.featured_image = null;
};

const fileBrowser = ref<HTMLInputElement | null>(null);
const fileSelector = () => {
    if (fileBrowser.value) {
        fileBrowser.value.click();
    }
};

const showImage = computed(() => {
    if (portfolio?.id && portfolio.featured_image) return true;
    else if (filePreview.value) return true;
    else return false;
});

const showWhichImage = computed(() => {
    if (filePreview.value) return filePreview.value.value;
    else if (portfolio?.id && portfolio.featured_image)
        return form.featured_image;
    else return false;
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
                            <editor v-model:content="form.content" />
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-card class="mb-3">
                            <v-card-text class="pb-0">
                                <v-label> Work Type </v-label>
                            </v-card-text>
                            <v-card-text class="pt-0">
                                <v-select
                                    v-model="form.portfolio_type_id"
                                    placeholder="Select one work type"
                                    item-title="title"
                                    item-value="id"
                                    hide-details
                                    :items="types"
                                    :error-messages="
                                        form.errors.portfolio_type_id
                                    "
                                ></v-select>
                            </v-card-text>
                        </v-card>

                        <v-card class="mb-3">
                            <v-card-text class="pb-0">
                                <v-label> Status </v-label>
                            </v-card-text>
                            <v-card-text class="pt-0">
                                <v-select
                                    v-model="form.status"
                                    hide-details
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

                        <v-card class="mb-3">
                            <v-card-text
                                class="pb-0 d-flex align-center justify-space-between"
                            >
                                <v-label> Featured Image </v-label>
                            </v-card-text>
                            <v-card-text class="pt-0">
                                <v-card border height="200">
                                    <template
                                        v-if="
                                            portfolio?.featured_image ||
                                            filePreview
                                        "
                                    >
                                    </template>

                                    <template v-if="showImage">
                                        <v-card-text class="pa-0">
                                            <v-hover
                                                #default="{ isHovering, props }"
                                            >
                                                <v-img
                                                    v-bind="props"
                                                    cover
                                                    height="200"
                                                    :src="showWhichImage"
                                                >
                                                    <v-fade-transition>
                                                        <template
                                                            v-if="isHovering"
                                                        >
                                                            <div
                                                                class="w-100 h-100 d-flex align-center justify-center"
                                                                style="
                                                                    background-color: rgba(
                                                                        0,
                                                                        0,
                                                                        0,
                                                                        0.5
                                                                    );
                                                                "
                                                            >
                                                                <v-btn
                                                                    v-tooltip="
                                                                        'Remove Featured Image'
                                                                    "
                                                                    rounded="circle"
                                                                    icon="carbon:close"
                                                                    @click="
                                                                        removeImage
                                                                    "
                                                                ></v-btn>
                                                            </div>
                                                        </template>
                                                    </v-fade-transition>
                                                </v-img>
                                            </v-hover>
                                        </v-card-text>
                                    </template>
                                    <template v-else>
                                        <v-card-text
                                            class="pt-0 w-100 h-100 d-flex align-center justify-center flex-column"
                                        >
                                            <div
                                                class="d-flex align-center justify-center flex-column mb-3"
                                            >
                                                <v-icon
                                                    size="32"
                                                    class="mb-2"
                                                    icon="carbon:cloud-upload"
                                                ></v-icon>
                                                <div
                                                    class="text-h6 font-weight-medium"
                                                >
                                                    Select Featured image
                                                </div>
                                            </div>
                                            <input
                                                ref="fileBrowser"
                                                id="file-browser"
                                                class="d-none"
                                                type="file"
                                                @input="uploadFile"
                                            />
                                            <v-btn border @click="fileSelector">
                                                Browse
                                            </v-btn>
                                        </v-card-text>
                                    </template>
                                </v-card>
                            </v-card-text>
                        </v-card>

                        <v-card class="mb-3">
                            <v-card-text class="pb-0">
                                <v-label> Actions </v-label>
                            </v-card-text>
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
                                    @click="router.visit('/admin/portfolio')"
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

<!-- <v-card class="mb-3">
                                <v-card-text class="pb-0">
                                    <v-label> Featured Image </v-label>
                                </v-card-text>
                                <v-card-text>
                                    Show existing image if available and no new image selected
                                    <div
                                        v-if="existingImageUrl && !imagePreview"
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

                                    Show preview of new file
                                    <div v-if="imagePreview" class="mb-3">
                                        <v-img
                                            :src="imagePreview"
                                            max-height="200"
                                            class="mb-2"
                                            cover
                                        ></v-img>
                                        <v-chip size="small" color="primary">
                                            New Image:
                                            {{ form.featured_image?.name }}</v-chip
                                        >
                                    </div>

                                    File input with proper v-model handling
                                    <v-file-input
                                        :model-value="
                                            form.featured_image
                                                ? [form.featured_image]
                                                : []
                                        "
                                        label="Choose featured image"
                                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                        prepend-icon="mdi-camera"
                                        :rules="rules.featured_image"
                                        :error-messages="form.errors.featured_image"
                                        @update:model-value="<any>handleFileChange"
                                        @click:clear="handleFileChange(null)"
                                    ></v-file-input>

                                    <v-card-subtitle class="px-0 text-caption">
                                        Accepted formats: JPEG, PNG, GIF, WebP (Max:
                                        5MB)
                                    </v-card-subtitle>
                                </v-card-text>
                            </v-card> -->
