<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineAsyncComponent } from 'vue';

const card = defineAsyncComponent(
    () => import('@/components/guest/shared/portfolio/card.vue'),
);

defineProps<{
    types: {
        id: number;
        title: string;
    }[];
    portfolios: {
        id: number;
        title: string;
        subtitle: string;
        slug: string;
        status: string;
        featured_image: string;
    }[];
}>();

const calcCol = (i: number) => {
    return (i + 1) % 3 ? 6 : 12;
};
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
                <v-row class="py-16">
                    <template
                        v-for="(portfolio, i) in portfolios"
                        :key="portfolio.id"
                    >
                        <v-col class="mb-6" cols="12" :md="calcCol(i)">
                            <card :portfolio />
                        </v-col>
                    </template>
                </v-row>
            </template>
            <template v-else>
                <v-alert border color="transparent">
                    Sorry no content available.
                </v-alert>
            </template>
        </v-container>
    </guest-layout>
</template>
