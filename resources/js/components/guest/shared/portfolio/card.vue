<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import type { Portfolio } from '@/types/portfolio';
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
  portfolio: Portfolio
}>();
</script>
<template>
  <v-hover v-slot="{ isHovering, props: hover }">
    <Link v-bind="hover" :href="'/portfolio/' + portfolio.slug" class="text-decoration-none text-white">
    <v-card flat max-height="500" width="auto" rounded="xl" :active="isHovering"
      :variant="isHovering ? 'tonal' : 'text'" class="mb-3">
      <v-img cover :aspect-ratio="1" width="100" height="100" class="w-100 h-100 align-end"
        :src="portfolio.featured_image" />
    </v-card>
    </Link>
    <v-card border="0" color="transparent" class="text-decoration-none">
      <v-list-item class="px-0">
        <v-list-item-title class="text-h5 mb-3 font-weight-bold">
          {{ portfolio.title }}
        </v-list-item-title>
        <v-list-item-subtitle class="text-body-1">
          {{ portfolio.type.title }}
        </v-list-item-subtitle>
        <template #append>
          <Link :href="'/portfolio/' + portfolio.slug" as="span">
          <v-btn icon border rounded="pill" width="70" height="50">
            <v-icon>
              <Icon icon="carbon:arrow-right" />
            </v-icon>
          </v-btn>
          </Link>
        </template>
      </v-list-item>
    </v-card>
  </v-hover>
</template>
