<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { pages } from '@/utils/constants/guestPage';
import { Link, usePage } from '@inertiajs/vue3';
import { useDisplay } from 'vuetify';

const page = usePage();

const { mobile } = useDisplay();

const getActive = (to: string) => {
  const currentUrl = page.url.endsWith('/') && page.url !== '/' ? page.url.slice(0, -1) : page.url;
  const normalizedTo = to.endsWith('/') && to !== '/' ? to.slice(0, -1) : to;
  return currentUrl === normalizedTo || currentUrl.startsWith(normalizedTo + '/');
};
</script>

<template>
  <v-card
    flat
    color="rgba(var(--v-theme-surface), 0.7)"
    :location="mobile ? 'bottom' : 'top'"
    rounded="pill"
    class="position-fixed pa-1 blur-8 z-1010"
    :class="[mobile ? 'bottom-10' : 'top-10']"
  >
    <v-tabs
      color="primary"
      density="compact"
      hide-slider
      show-arrows
      height="50"
      rounded="pill"
    >
      <template
        v-for="{ icon, title, to } in pages"
        :key="title"
      >
        <Link
          :href="to"
          as="span"
          prefetch
        >
          <v-tab
            rounded="pill"
            :active="getActive(to)"
            :stacked="mobile"
          >
            <v-icon
              :start="!mobile"
              :icon
            />{{ title }}
          </v-tab>
        </Link>
      </template>
    </v-tabs>
  </v-card>
</template>
