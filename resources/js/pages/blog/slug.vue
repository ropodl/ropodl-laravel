<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { defineAsyncComponent, ref } from 'vue';

const GuestLayout = defineAsyncComponent(
    () => import('@/layouts/GuestLayout.vue'),
);
const Dynamic = defineAsyncComponent(
    () => import('@/components/shared/dynamic.vue'),
);

const blog = ref({
    date: '',
    slug: 'hi',
    title: 'Asus TUF Gaming F16 (2025) launched in Nepal with RTX 5060 GPU',
    featured_image:
        'https://images.unsplash.com/photo-1758001606578-09b352df5b85?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
    excerpt: 'this is a tests',
    content: `<p>asdasd</p>`,
});
</script>
<template>
    <Head>
        <title>{{ blog.title }}</title>
    </Head>
    <guest-layout class="mt-6">
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-card border rounded="xl">
                        <v-img
                            cover
                            :aspect-ratio="16 / 8"
                            :src="blog.featured_image"
                        ></v-img>
                    </v-card>
                </v-col>
            </v-row>
            <v-row v-if="blog.excerpt">
                <v-col cols="12" md="12">
                    <v-card-title
                        class="text-md-h2 text-h4 font-weight-bold px-0 pt-0"
                        style="line-height: 1.2; white-space: unset !important"
                    >
                        {{ blog.title }}
                    </v-card-title>
                    <div class="text-h6 text-sm-h4 font-weight-light">
                        {{ blog.excerpt }}
                    </div>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12">
                    <template v-if="blog.content">
                        <dynamic :content="blog.content" />
                    </template>
                </v-col>
            </v-row>
        </v-container>
    </guest-layout>
</template>
