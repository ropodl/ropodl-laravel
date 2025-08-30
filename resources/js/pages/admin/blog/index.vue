<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Blogs</title>
    </Head>
    <AuthenticatedLayout title="Blogs List">
        blog listing page
    </AuthenticatedLayout>
</template>
