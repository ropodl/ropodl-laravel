<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

type blogs = {
    date: string;
    slug: string;
    title: string;
    featured_image: {
        name: string;
        url: string;
    };
};

const loading = ref(false);
const blogs = ref<blogs[]>([
    {
        date: '',
        slug: 'hi',
        title: 'This is a test',
        featured_image: { name: 'test', url: '/media/avatar.webp' },
    },
    {
        date: '',
        slug: 'hi',
        title: 'This is a test',
        featured_image: { name: 'test', url: '/media/avatar.webp' },
    },
]);
</script>

<template>
    <guest-layout title="Blogs." class="mt-16">
        <v-container>
            <template v-if="loading">
                <v-row>
                    <v-col>
                        <v-progress-circular
                            indeterminate
                        ></v-progress-circular>
                    </v-col>
                </v-row>
            </template>
            <template v-else>
                <template v-if="blogs.length">
                    <v-row>
                        <template
                            v-for="{
                                slug,
                                title,
                                featured_image: { name, url },
                            } in blogs"
                            :key="title"
                        >
                            <v-col cols="12" sm="6" md="6" lg="4">
                                <Link :href="`/blog/${slug}`" as="span">
                                    <v-hover v-slot="{ isHovering, props }">
                                        <v-card
                                            v-bind="props"
                                            border="0"
                                            rounded="0"
                                            :variant="
                                                isHovering ? 'tonal' : 'text'
                                            "
                                            :color="
                                                isHovering
                                                    ? 'rgba(var(--v-theme-primary),0.1)'
                                                    : 'transparent'
                                            "
                                            class="h-100"
                                            :to="`/blogs/${slug}`"
                                        >
                                            <v-card
                                                border
                                                flat
                                                height="250"
                                                class="mb-3"
                                            >
                                                <v-img
                                                    cover
                                                    class="w-100 h-100"
                                                    :class="[
                                                        isHovering
                                                            ? 'zoom-image active'
                                                            : '',
                                                    ]"
                                                    :src="url"
                                                    :alt="name"
                                                >
                                                    <template
                                                        v-slot:placeholder
                                                    >
                                                        <div
                                                            class="d-flex align-center justify-center fill-height"
                                                        >
                                                            <v-skeleton-loader
                                                                class="w-100 h-100"
                                                                type="image"
                                                            ></v-skeleton-loader>
                                                        </div>
                                                    </template>
                                                </v-img>
                                            </v-card>
                                            <v-card-text
                                                class="pt-2 text-h6 font-weight-light text-white px-0 pb-0 line-clamp-3"
                                                style="
                                                    line-height: normal;
                                                    white-space: normal;
                                                "
                                            >
                                                {{ title }}
                                            </v-card-text>
                                            <v-card-text
                                                class="text-white text-caption pl-0 font-weight-light"
                                            >
                                                April 20, 2025
                                                <!-- {{
                                                    date.format(
                                                        createdAt,
                                                        'fullDate',
                                                    )
                                                }} -->
                                            </v-card-text>
                                        </v-card>
                                    </v-hover>
                                    <v-divider></v-divider>
                                </Link>
                            </v-col>
                        </template>
                    </v-row>
                </template>
                <template v-else>
                    <v-row>
                        <v-col cols="12">
                            <v-card border>
                                <v-card-text>
                                    Sorry, content not available at the moment.
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </template>
            </template>
            <!-- <template v-if="pagination?.totalPage > 1">
        <v-col cols="12" md="12">
          <v-pagination
            v-model="page"
            density="compact"
            :length="pagination.totalPage"
            show-first-last-page
            @update:modelValue="test"
          ></v-pagination>
        </v-col>
      </template> -->
        </v-container>
    </guest-layout>
</template>
