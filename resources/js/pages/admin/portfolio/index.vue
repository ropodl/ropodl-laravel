<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { right } from '@/composables/nav';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import type { Portfolio } from '@/types/portfolio';
import { itemsPerPage } from '@/utils/constants';
import { clearParamKey } from '@/utils/global';
import { Icon } from '@iconify/vue';
import { Head, router } from '@inertiajs/vue3';
import { useDateFormat, useDebounceFn } from '@vueuse/core';
import { defineAsyncComponent, ref } from 'vue';

const breadcrumbs = defineAsyncComponent(() => import('@/components/admin/layout/breadcrumbs.vue'));

const { portfolios, search, pagination } = defineProps<{
  portfolios: Portfolio[];
  search?: string;
  pagination: pagination;
}>();

const searchQuery = ref(search);
const paginate = ref(pagination);
const filters = ref({
  status: null,
});

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
    status: filters.value.status,
  };

  router.get(route('portfolio.index'), clearParamKey(params), {
    showProgress: true,
    async: true,
    preserveState: true,
    preserveScroll: true,
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

const resetFilters = () => {};

const actions = ref([
  {
    icon: 'carbon:edit',
    title: 'Edit Blog',
    method: (id: number) => {
      router.visit(`/admin/portfolio/${id}`);
    },
  },
  {
    icon: 'carbon:bin',
    title: 'Delete Blog',
    method: (id) => {
      router.visit(`/admin/portfolio/${id}`);
    },
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
      <v-row class="mb-1">
        <v-col cols="12">
          <div class="text-h4 font-weight-bold">Portfolio</div>
        </v-col>
      </v-row>
      <v-card
        class="position-sticky top-0 mb-3"
        style="z-index: 1"
      >
        <v-card-text>
          <v-row align="center">
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="searchQuery"
                hide-details
                clearable
                persistent-clear
                rounded="lg"
                placeholder="Search portfolios"
                @update:model-value="handleSearch"
              >
                <template #prepend-inner>
                  <v-icon>
                    <Icon icon="carbon:search" />
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-spacer></v-spacer>
            <v-col
              cols="12"
              md="6"
            >
              <div class="d-flex">
                <v-spacer></v-spacer>
                <v-btn
                  v-tooltip:top="'Filters'"
                  flat
                  class="me-3"
                  @click="right = !right"
                >
                  <v-icon>
                    <Icon icon="carbon:filter" />
                  </v-icon>
                </v-btn>
                <v-btn
                  flat
                  color="primary"
                  @click="router.visit('/admin/portfolio/create')"
                >
                  Add New
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
      <v-row>
        <v-col cols="12">
          <v-card rounded="lg">
            <v-data-table-server
              :headers="headers"
              :items="portfolios"
              :items-length="pagination.total"
              :page="pagination.current_page"
              :items-per-page="pagination.per_page"
              hide-default-footer
              @update:sort-by="getUpdate"
            >
              <template #[`item.status`]="{ value }">
                <v-chip
                  :color="getColor(value)"
                  variant="tonal"
                  class="text-capitalize"
                >
                  {{ value }}
                </v-chip>
              </template>
              <template #[`item.created_at`]="{ value }">
                {{ useDateFormat(value, 'MMMM DD, YYYY') }}
              </template>
              <template #[`item.actions`]="{ item }">
                <!-- <v-hover #default="{ isHovering, props }">
                  <v-btn
                    v-bind="props"
                    icon
                    size="small"
                    rounded="lg"
                    :variant="isHovering ? 'tonal' : 'text'"
                    @click="router.visit(`/admin/portfolio/${item.id}`)"
                  >
                    <v-icon icon="carbon:edit" />
                  </v-btn>
                </v-hover> -->
                <v-menu>
                  <template v-slot:activator="{ props }">
                    <v-btn
                      v-bind="props"
                      rounded="0"
                      height="44"
                      size="small"
                      icon="carbon:chevron-down"
                    ></v-btn>
                  </template>
                  <v-list density="compact">
                    <template
                      v-for="({ icon, title, method }, index) in actions"
                      :key="index"
                    >
                      <v-list-item
                        :value="index"
                        :prepend-icon="icon"
                        :title
                        @click="method && method(item.id)"
                      ></v-list-item>
                    </template>
                  </v-list>
                </v-menu>
              </template>
            </v-data-table-server>
          </v-card>
        </v-col>
      </v-row>
      <v-row align="center">
        <v-col
          cols="12"
          md="6"
        >
          <div class="d-flex justify-start">
            <v-pagination
              v-model="paginate.current_page"
              density="compact"
              :total-visible="5"
              :length="pagination.last_page"
              @update:model-value="
                (value) => {
                  paginate.current_page = value;
                  getUpdate([]);
                }
              "
            ></v-pagination>
          </div>
        </v-col>
        <v-col
          cols="12"
          md="6"
        >
          <div class="d-flex align-center justify-end">
            <span class="mr-3">Items Per Page:</span>
            <v-select
              v-model="paginate.per_page"
              hide-details
              density="compact"
              max-width="100"
              :items="itemsPerPage"
              @update:model-value="
                (value) => {
                  paginate.per_page = value;
                  getUpdate([]);
                }
              "
            ></v-select>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <template #right-nav-body>
      <v-label>Portfolio Status</v-label>
      <v-select
        v-model="filters.status"
        placeholder="Select Portfolio Status"
        clearable
        persistent-clear
        :items="[
          {
            title: 'Published',
            value: 'published',
          },
          { title: 'Draft', value: 'draft' },
        ]"
        @update:modelValue="getUpdate([])"
      ></v-select>
    </template>
    <template #right-nav-append>
      <v-btn
        block
        @click="resetFilters"
      >
        Reset Filters
      </v-btn>
    </template>
  </AuthenticatedLayout>
</template>
