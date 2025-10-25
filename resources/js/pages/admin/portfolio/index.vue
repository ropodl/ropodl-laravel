<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { right } from '@/composables/nav';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import type { Portfolio } from '@/types/portfolio';
import { itemsPerPage } from '@/utils/constants';
import { Icon } from '@iconify/vue';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { defineAsyncComponent, ref } from 'vue';

const breadcrumbs = defineAsyncComponent(() => import('@/components/admin/layout/breadcrumbs.vue'));

const { portfolios, search, pagination } = defineProps<{
  portfolios: Portfolio[];
  search?: string;
  pagination: pagination;
}>();

const searchQuery = ref(search);
const paginate = ref(pagination);

const headers = [
  { title: 'Title', key: 'title', sortable: true },
  { title: 'Status', key: 'status', sortable: true },
  { title: 'Created At', key: 'created_at', sortable: true },
  { title: 'Actions', key: 'actions', sortable: false },
];

const getUpdate = (options: { key: string; order?: boolean }[]) => {
  const params = {
    search: searchQuery.value,
    page: paginate.value.current_page,
    per_page: paginate.value.per_page,
    sort_by: options[0],
  };

  router.get(route('portfolio.index'), params, {
    showProgress: true,
    async: true,
    preserveState: true,
    preserveScroll: true,
    replace: false,
  });
};

// Add debounced search handler
const handleSearch = useDebounceFn((value: string) => {
  searchQuery.value = value;
  paginate.value.current_page = 1; // Reset to first page when searching
  getUpdate([]);
}, 300);

const getColor = (value: string) => {
  return value === 'published' ? 'green' : 'yellow';
};

const bread = ref<BreadcrumbItem[]>([
  {
    title: 'portfolio',
    href: '/admin/portfolio',
  },
]);
</script>

<template>

  <Head>
    <title>Portfolios</title>
  </Head>
  <AuthenticatedLayout title="Portfolios List">
    <v-container>
      <breadcrumbs :items="bread" />
      <v-row align="center">
        <v-col cols="12" md="4">
          <v-text-field v-model="searchQuery" hide-details clearable persistent-clear rounded="lg"
            placeholder="Search portfolios" @update:model-value="handleSearch">
            <template #prepend-inner>
              <v-icon>
                <Icon icon="carbon:search" />
              </v-icon>
            </template>
          </v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <v-col cols="12" md="6">
          <div class="d-flex">
            <v-spacer></v-spacer>
            <v-btn v-tooltip:top="'Filters'" flat class="me-3" @click="right = !right">
              <v-icon>
                <Icon icon="carbon:filter" />
              </v-icon>
            </v-btn>
            <v-btn flat color="primary" @click="router.visit('/admin/portfolio/create')">
              Add New
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-card rounded="lg">
            <v-data-table-server :headers="headers" :items="portfolios" :items-length="pagination.total"
              :page="pagination.current_page" :items-per-page="pagination.per_page" hide-default-footer
              @update:sort-by="getUpdate">
              <template v-slot:[`item.status`]="{ value }">
                <v-chip :color="getColor(value)" variant="tonal" size="small">
                  {{ value }}
                </v-chip>
              </template>
              <template v-slot:[`item.actions`]="{ item }">
                <v-hover v-slot:default="{ isHovering, props }">
                  <v-btn v-bind="props" icon size="small" rounded="lg" :variant="isHovering ? 'tonal' : 'text'"
                    @click="router.visit(`/admin/portfolio/${item.id}`)">
                    <v-icon>
                      <Icon icon="carbon:edit" />
                    </v-icon>
                  </v-btn>
                </v-hover>
              </template>
            </v-data-table-server>
          </v-card>
        </v-col>
      </v-row>
      <v-row align="center">
        <v-col cols="12" md="6">
          <div class="d-flex justify-start">
            <v-pagination v-model="paginate.current_page" density="compact" :total-visible="5"
              :length="paginate.last_page" @update:model-value="
                (value) => {
                  paginate.current_page = value;
                  getUpdate([]);
                }
              "></v-pagination>
          </div>
        </v-col>
        <v-col cols="12" md="6">
          <div class="d-flex align-center justify-end">
            <span class="mr-3">Items Per Page:</span>
            <v-select v-model="paginate.per_page" hide-details density="compact" max-width="100" :items="itemsPerPage"
              @update:model-value="
                (value) => {
                  paginate.per_page = value;
                  getUpdate([]);
                }
              "></v-select>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <template #right-nav-body>
      <v-label>Portfolio Status</v-label>
      <v-select placeholder="Select Portfolio Status" :items="[
        {
          title: 'Published',
          value: 'published',
        },
        { title: 'Draft', value: 'draft' },
      ]"></v-select>
    </template>
    <template #right-nav-append>
      <v-btn block class="mb-3" color="primary">Apply</v-btn>
      <v-btn block @click="right = false">Cancel</v-btn>
    </template>
  </AuthenticatedLayout>
</template>
