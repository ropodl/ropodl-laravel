<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { itemsPerPage } from '@/utils/constants';
import { Head, router } from '@inertiajs/vue3';
import { defineAsyncComponent, ref } from 'vue';

const breadcrumbs = defineAsyncComponent(
    () => import('@/components/admin/layout/breadcrumbs.vue'),
);
const addNewDialog = defineAsyncComponent(
    () => import('@/components/admin/shared/portfolio/type/addNewDialog.vue'),
);

const { types, search, pagination } = defineProps<{
    types: object;
    search?: string;
    pagination: pagination;
}>();

const searchQuery = ref(search);
const paginate = ref(pagination);

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
        preserveState: false,
        preserveScroll: false,
        replace: true,
        only: ['types', 'pagination'],
    });
};

const bread = ref<BreadcrumbItem[]>([
    {
        title: 'portfolio',
        href: '/admin/portfolio',
    },
    {
        title: 'types',
        href: '/admin/portfolio-type',
    },
]);
</script>
<template>
    <Head>Portfolio Type</Head>
    <AuthenticatedLayout title="Portfolio Type">
        <v-container>
            <breadcrumbs :items="bread" />
            <v-row align="center">
                <v-col cols="12" md="4">
                    <v-text-field hide-details></v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="12" md="6">
                    <div class="d-flex">
                        <v-spacer></v-spacer>
                        <!-- <v-btn flat color="primary">Add New</v-btn> -->
                        <add-new-dialog />
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-card rounded="lg">
                        <v-data-table-server
                            hide-default-footer
                            :items="<any>types"
                            :items-length="10"
                            :items-per-page="10"
                        ></v-data-table-server>
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
                            @update:model-value="
                                (value) => {
                                    paginate.current_page = value;
                                    getUpdate([]);
                                }
                            "
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
    </AuthenticatedLayout>
</template>

<style></style>
