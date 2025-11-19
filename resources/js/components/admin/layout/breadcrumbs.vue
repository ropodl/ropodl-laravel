<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

const { items } = defineProps<{
  items: BreadcrumbItem[];
  back?: boolean;
}>();

const bread = [{ title: '', href: '' }, ...items];
</script>
<template>
  <v-row>
    <v-col cols="12">
      <div class="d-flex align-center">
        <template v-if="back">
          <v-btn
            border
            icon
            size="small"
          >
            <v-icon>
              <Icon icon="carbon:arrow-left" />
            </v-icon>
          </v-btn>
        </template>
        <v-breadcrumbs
          density="compact"
          :items="bread"
          class="pa-0"
        >
          <template v-slot:prepend>
            <Link
              class="text-decoration-none text-white"
              href="/admin/"
            >
              <v-icon>
                <Icon icon="carbon:home" />
              </v-icon>
            </Link>
          </template>
          <template #title="{ item }">
            <Link
              class="text-decoration-none text-white"
              :href="item.href"
            >
              {{ item.title }}
            </Link>
          </template>
        </v-breadcrumbs>
      </div>
    </v-col>
  </v-row>
</template>
