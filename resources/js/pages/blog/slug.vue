<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import type { blog } from '@/types/blog';
import { Head } from '@inertiajs/vue3';
import { defineAsyncComponent } from 'vue';

const GuestLayout = defineAsyncComponent(() => import('@/layouts/GuestLayout.vue'));
const Dynamic = defineAsyncComponent(() => import('@/components/shared/dynamic.vue'));

defineProps<{
  blog: blog;
}>();
</script>
<template>
  <Head>
    <title>{{ blog.title }}</title>
  </Head>
  <guest-layout class="mt-16">
    <v-container>
      <v-row v-if="blog.excerpt">
        <v-col
          cols="12"
          md="12"
        >
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
      <v-row>
        <v-col cols="12">
          <v-card
            border
            rounded="xl"
          >
            <v-img
              cover
              :aspect-ratio="16 / 8"
              :src="blog.featured_image"
            ></v-img>
          </v-card>
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
