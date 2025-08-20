<script setup lang="ts">
import { defineAsyncComponent } from 'vue';

const GuestLayout = defineAsyncComponent(
    () => import('@/layouts/GuestLayout.vue'),
);
</script>

<template>
    <GuestLayout> About Pagee </GuestLayout>
</template>
