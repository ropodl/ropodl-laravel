<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineAsyncComponent } from 'vue';

const dynamicContent = defineAsyncComponent(
    () => import('@/components/shared/dynamic.vue'),
);

defineProps<{
    portfolio: {
        id: number;
        title: string;
        slug: string;
        content: string;
        status: string;
        type_id: number;
        created_at: string;
        updated_at: string;
        featured_image: string;
    };
}>();
</script>

<template>
    <Head>
        <title>{{ portfolio.title }}</title>
    </Head>
    <GuestLayout class="mt-16">
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-card class="mb-6">
                        <v-img
                            cover
                            height="500"
                            :src="portfolio.featured_image"
                        ></v-img>
                    </v-card>

                    <v-card-title>{{ portfolio.title }}</v-card-title>
                    <v-card-text>
                        <dynamic-content :content="portfolio.content" />
                    </v-card-text>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
