<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// const current = ref(0);

defineProps<{
    types: {
        id: number;
        title: string;
    }[];
    portfolios: {
        id: number;
        title: string;
        slug: string;
        status: string;
        featured_image: string;
    }[];
}>();
</script>
<template>
    <Head>
        <title>Portfolio</title>
    </Head>
    <guest-layout class="mt-16">
        <template #title>
            Look at what I've been
            <span class="text-primary-darken-2">working on</span>.
        </template>
        <v-container>
            <template v-if="portfolios.length">
                <v-row>
                    <template
                        v-for="{
                            id,
                            title,
                            slug,
                            featured_image,
                        } in portfolios"
                        :key="id"
                    >
                        <v-col cols="12" md="4">
                            <v-hover v-slot="{ isHovering, props: hover }">
                                <Link
                                    :href="'/portfolio/' + slug"
                                    class="text-decoration-none"
                                >
                                    <v-card
                                        flat
                                        max-height="500"
                                        width="auto"
                                        rounded="lg"
                                        v-bind="hover"
                                    >
                                        <v-img
                                            cover
                                            :aspect-ratio="1"
                                            width="100"
                                            height="100"
                                            class="w-100 h-100 align-end"
                                            :class="
                                                isHovering ? 'zoom-image' : ''
                                            "
                                            :src="featured_image"
                                        >
                                            <v-card
                                                rounded="0"
                                                elevation="10"
                                                class="blur-8 border border-s-0 border-e-0 border-b-0"
                                                style="
                                                    background-color: rgba(
                                                        var(--v-theme-surface),
                                                        0.8
                                                    );
                                                "
                                            >
                                                <v-card-text
                                                    class="text-center"
                                                    style="white-space: normal"
                                                >
                                                    {{ title }}
                                                </v-card-text>
                                            </v-card>
                                        </v-img>
                                    </v-card>
                                </Link>
                            </v-hover>
                        </v-col>
                    </template>
                </v-row>
            </template>
        </v-container>
    </guest-layout>
</template>
