<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout title="Dashboard">
    <v-container>
      <v-row>
        <v-col cols="12"> You're logged in! </v-col>
      </v-row>
    </v-container>
    <template #right-nav> asasd </template>
  </AuthenticatedLayout>
</template>
