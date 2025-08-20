<script setup lang="ts">
import { defineAsyncComponent } from 'vue';

const navbar = defineAsyncComponent(
    () => import('@/components/guest/layout/navbar.vue'),
);
</script>

<template>
    <v-app>
        <navbar />
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
