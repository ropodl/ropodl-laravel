<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { useNavDrawerStore } from '@/store/admin/nav';
import { Icon } from '@iconify/vue';
import { Head, router } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import { ref } from 'vue';
import { portfolio } from './portfolio';

const { portfolios, pagination } = defineProps<{
    portfolios: portfolio[];
    filters: object;
    pagination: pagination;
}>();

const nav = useNavDrawerStore();
const { right } = storeToRefs(nav);

// const filter = ref(filters);
const paginate = ref(pagination);

// Headers for the v-data-table-server
const headers = [
    { title: 'Title', key: 'title' },
    { title: 'Status', key: 'status' },
    { title: 'Created At', key: 'created_at' },
    { title: 'Actions', key: 'actions' },
];

const getUpdate = () => {
    router.get(
        route('portfolio.index'),
        {
            search: '',
            page: paginate.value.current_page,
            per_page: paginate.value.per_page,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
};

const getColor = (value: string) => {
    return value === 'published' ? 'green' : 'yellow';
};
</script>

<template>
    <Head>
        <title>Portfolios</title>
    </Head>
    <AuthenticatedLayout title="Portfolios List">
        <v-container>
            <v-row align="center">
                <v-col cols="12" md="4">
                    <!-- v-model="filters.search" -->
                    <v-text-field
                        hide-details
                        clearable
                        persistent-clear
                        rounded="lg"
                        placeholder="Search portfolios"
                    >
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
                            >Add New</v-btn
                        >
                    </div>
                </v-col>
            </v-row>
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
                        >
                            <template v-slot:[`item.status`]="{ value }">
                                <v-chip
                                    :color="getColor(value)"
                                    variant="tonal"
                                    size="small"
                                >
                                    {{ value }}
                                </v-chip>
                            </template>
                            <template v-slot:[`item.actions`]="{ item }">
                                {{ item }}
                                <v-btn
                                    @click="
                                        router.visit(
                                            `/admin/portfolio/${item.id}`,
                                        )
                                    "
                                >
                                    <v-icon>
                                        <Icon icon="carbon:edit" />
                                    </v-icon>
                                </v-btn>
                            </template>
                        </v-data-table-server>
                    </v-card>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col cols="12" md="6">
                    <div class="d-flex justify-start">
                        <v-pagination
                            v-model="paginate.current_page"
                            density="compact"
                            :total-visible="5"
                            :length="paginate.last_page"
                            @update:model-value="getUpdate"
                        ></v-pagination>
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="d-flex align-center justify-end">
                        <span class="mr-3">Items Per Page:</span>
                        <v-select
                            v-model="paginate.per_page"
                            hide-details
                            density="compact"
                            max-width="100"
                            :items="[10, 25, 50, 75, 100]"
                            @update:model-value="getUpdate"
                        ></v-select>
                    </div>
                </v-col>
            </v-row>
        </v-container>
        <template #right-nav-body>
            <v-select :items="['a', 'b', 'c']"></v-select>
        </template>
        <template #right-nav-append>
            <v-btn block class="mb-3" color="primary">Apply</v-btn>
            <v-btn block @click="right = false">Cancel</v-btn>
        </template>
    </AuthenticatedLayout>
</template>
