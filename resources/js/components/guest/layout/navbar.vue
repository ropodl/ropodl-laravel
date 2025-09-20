<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { pages } from '@/utils/constants';
import { Icon } from '@iconify/vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const getActive = (to: string) => {
    const currentUrl =
        page.url.endsWith('/') && page.url !== '/'
            ? page.url.slice(0, -1)
            : page.url;
    const normalizedTo = to.endsWith('/') && to !== '/' ? to.slice(0, -1) : to;
    return (
        currentUrl === normalizedTo || currentUrl.startsWith(normalizedTo + '/')
    );
};
</script>

<template>
    <v-card
        flat
        color="rgba(var(--v-theme-surface), 0.7)"
        rounded="pill"
        location="top"
        class="position-fixed pa-1 blur-8 top-10 z-1010"
    >
        <v-tabs
            color="primary"
            density="compact"
            hide-slider
            show-arrows
            rounded="pill"
        >
            <template v-for="{ icon, title, to } in pages" :key="title">
                <Link :href="to" as="span" prefetch>
                    <v-tab rounded="pill" :active="getActive(to)">
                        <template #prepend>
                            <v-icon start>
                                <Icon :icon="icon" />
                            </v-icon>
                        </template>
                        {{ title }}
                    </v-tab>
                </Link>
            </template>
        </v-tabs>
    </v-card>
</template>
