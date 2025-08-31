<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { pages } from '@/utils/constants';
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <v-card
        flat
        color="rgba(var(--v-theme-surface), 0.7)"
        rounded="lg"
        location="top"
        class="position-fixed pa-1 blur-8 top-10 z-1010"
    >
        <v-tabs
            color="primary"
            density="compact"
            hide-slider
            show-arrows
            rounded="lg"
        >
            <template v-for="{ icon, title, to } in pages" :key="title">
                <Link :href="to" as="span" prefetch>
                    <v-tab
                        color="brand"
                        rounded="lg"
                        :variant="$page.url === to ? 'tonal' : 'text'"
                    >
                        <template #prepend>
                            <v-icon start>
                                <Icon :icon />
                            </v-icon>
                        </template>
                        {{ title }}.
                    </v-tab>
                </Link>
            </template>
        </v-tabs>
    </v-card>
</template>
